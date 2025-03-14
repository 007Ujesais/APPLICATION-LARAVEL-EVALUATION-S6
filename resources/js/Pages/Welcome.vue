<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ToggleDarkMode from '@/Components/ToggleDarkMode.vue';

import { onMounted, ref } from "vue";
import gsap from "gsap";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const toggleDarkModeRef = ref(null);

const textRef = ref(null);
const textRef2 = ref(null);

const cursorRef = ref(null);

onMounted(() => {

  textRef.value.innerHTML = getlettre(textRef);
  textRef2.value.innerHTML = getlettre(textRef2);

  
  const letterSpans = textRef.value.children;

  // Effet d'apparition du texte
  gsap.fromTo(
    textRef2.value.children,
    { yPercent: 100, rotate: 10, opacity: 0 },
    { yPercent: 0, rotate: 0, opacity: 1, stagger: 0.05, duration: 0.01, ease: "expo.out" }
  );

  // Curseur personnalisé fluide
  const moveCursor = gsap.quickTo(cursorRef.value, "x,y", { duration: 0.2, ease: "power2.out" });

function getlettre(textRef) {
  const letters = textRef.value.innerText.split("").map(letter => {
    return `<span class="inline-block transition-transform">${letter === " " ? "&nbsp;" : letter}</span>`;
  }).join("");
  return letters;
}

function lerp(a, b, t) {
  return a + (b - a) * t;
}

const prevMousePos = { x: 0, y: 0 }; // Stocke la dernière position lissée
const prevStrengths = new Map();

document.addEventListener("mousemove", (e) => {
  // Interpolation pour lisser le saut de la grille
  prevMousePos.x = lerp(prevMousePos.x, Math.round(e.clientX / 70) * 70, 0.2);
  prevMousePos.y = lerp(prevMousePos.y, Math.round(e.clientY / 70) * 70, 0.2);

  Array.from(letterSpans).forEach((letter) => {
    const rect = letter.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;

    const dx = prevMousePos.x - centerX;
    const dy = prevMousePos.y - centerY;
    const distance = Math.sqrt(dx ** 2 + dy ** 2);

    let targetStrength = distance < 140 ? (1 - distance / 120) * 70 : 0;

    // Appliquer le lissage sur l'effet des lettres
    let prevStrength = prevStrengths.get(letter) || 0;
    let smoothedStrength = lerp(prevStrength, targetStrength, 1);

    prevStrengths.set(letter, smoothedStrength);

    // Déterminer si la lettre est au-dessus ou en dessous du curseur
    const yOffset = dy > 0 ? -smoothedStrength : smoothedStrength;

    // Calculer l'angle de rotation en fonction de l'écart horizontal
    const angle = (dx / distance) * 15; // 15° max d'inclinaison

    gsap.to(letter, {
      y: yOffset,
      // rotate: angle,
      opacity: distance < 140 ? 1 : 0.3, 
      duration: 0.01, // Animation fluide
      ease: "expo.out" 
    });
  });
});


});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots bg-center selection:bg-gray-300 selection:text-black"
    >
        <Menubar class="sm:fixed sm:top-0 sm:right-0 w-full bg-none p-7 text-right z-30 px-8">
          <template #start>
              <ApplicationLogo class="w-9 h-9 fill-current text-gray-500" /> <p class="font-semibold text">MYAPP</p>
          </template>
          <template #end>
            <div v-if="canLogin" >
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('home')"
                    class="font-semibold text hover:text-gray-900 dark:text-gray-400 dark:hover:text-blue-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Home</Link
                >
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="font-semibold text hover:text-gray-900 dark:text-gray-400 dark:hover:text-blue-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                        >Log in</Link
                    > 
    
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 font-semibold text hover:text-gray-900 dark:text-gray-400 dark:hover:text-blue-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                        >Register</Link
                    >
                </template>
            </div>
          </template>
        </Menubar>

        <ScrollPanel>
        <div class="py-2 sm:py-3">
            <div class="w-full flex flex-col items-center md:w-auto px-14 pt-7">
              <ToggleDarkMode ref="toggleDarkModeRef" />
                <div class="grid grid-cols-3 gap-4 sm:grid-cols-4 sm:mt-4 lg:grid-cols-4 lg:grid-rows-3 h-[770px]">
                    <div class="col-span-2 row-span-3 rounded-[30px] p-6 relative ">
                        <div class="flex flex-col h-full px-8 pt-8 sm:px-3 sm:pt-3">
                            <p class="mb-auto max-w-lg text-sm/6 text max-lg:text-center">
                              Lorem ipsum, dolor sit amet consectetur adipisicing elit maiores impedit.
                              Lorem ipsum, dolor sit amet consectetur adipisicing elit maiores impedit.
                            </p>
                            <h1 ref="textRef" class="mx-auto mt-2 uppercase text-4xl font-semibold tracking-tight text-balance text sm:text-7xl select-none">REAL DESINGS BY REAL ARTISTS FOR REAL PEOPLE</h1>
                        </div>
                    </div>

                    <div class="col-span-2 row-span-2 bg rounded-[30px] p-6 relative">
                        <div class="flex flex-col h-full px-8 pt-8 sm:px-3 sm:pt-3">
                          <h1 ref="textRef2" class="mx-auto mt-2 text-contrast z-20 text-4xl font-semibold tracking-tight text-balance sm:text-8xl select-none">Welcome to my project.</h1>
                          <p class="mt-auto max-w-lg text-sm/6 text-contrast z-20 max-lg:text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit maiores impedit.</p>
                        </div>
                    </div>

                    <div class=" rounded-[30px] p-6 relative"> 
                        <div class="px-8 pt-8 sm:px-3 sm:pt-3">
                            <p class="mt-2 text-lg font-medium tracking-tight text max-lg:text-center">Security</p>
                            <p class="mt-2 max-w-lg text-sm/6 text max-lg:text-center">Morbi viverra dui mi arcu sed. Tellus semper adipiscing suspendisse semper morbi.</p>
                        </div>
                    </div>

                    <div class=" rounded-[30px] p-6 relative">
                        <div class="px-8 pt-8 pb-3 sm:px-3 sm:pt-3 sm:pb-0">
                            <p class="mt-2 text-lg font-medium tracking-tight text max-lg:text-center">Powerful APIs</p>
                            <p class="mt-2 max-w-lg text-sm/6 text max-lg:text-center">Sit quis amet rutrum tellus ullamcorper ultricies libero dolor eget sem sodales gravida.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </ScrollPanel>
    </div>
</template>

<style scoped>
.bg-none {
  background: none;
  border: none;
  /* padding: 40px; */
}
.bg {
    overflow: hidden;
    position: relative;
    background-image: url("../../img/filingR.gif"),  url("../../img/filingL.gif");
    background-size: 30rem, 30rem;
    background-position: left top, right -2px top;
    background-repeat: no-repeat, repeat;
}

/* Overlay par défaut */
.bg::after {
    content: "";
    position: absolute;
    border-radius: inherit;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: contrast(3);
    z-index: 1;
}

/* Mode sombre activé avec Vue.js */
.my-app-dark .bg::after {
    backdrop-filter: contrast(3) invert(1); 
}


.text-contrast {
    color: var(--p-button-contrast-color); 
}

.text {
    color: var(--p-text-color);
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>






<!-- <script setup>
import { onMounted, ref } from "vue";
import gsap from "gsap";

const textRef = ref(null);
const cursorRef = ref(null);

onMounted(() => {
  const letters = textRef.value.innerText.split("").map(letter => {
    return `<span class="inline-block transition-transform">${letter === " " ? "&nbsp;" : letter}</span>`;
  }).join("");

  textRef.value.innerHTML = letters;
  
  const letterSpans = textRef.value.children;

  // Effet d'apparition du texte
//   gsap.fromTo(
//     letterSpans,
//     { yPercent: 140, rotate: 10, opacity: 0 },
//     { yPercent: 0, rotate: 0, opacity: 1, stagger: 0.05, duration: 1.2, ease: "expo.out" }
//   );

  // Curseur personnalisé fluide
  const moveCursor = gsap.quickTo(cursorRef.value, "x,y", { duration: 0.2, ease: "power2.out" });

  document.addEventListener("mousemove", (e) => {
    // Effet de bosse plus fluide
    Array.from(letterSpans).forEach((letter, index) => {
      const rect = letter.getBoundingClientRect();
      const distance = Math.sqrt((e.clientX - (rect.left + rect.width / 2)) ** 2 + (e.clientY - (rect.top + rect.height / 2)) ** 2);
      
      if (distance < 140) {
        const strength = (1 - distance / 120) * 50;
        gsap.to(letter, { y: -strength,  opacity: 1, duration: 0.001, ease: "power2.out" });
      } else {
        gsap.to(letter, { y: 0, duration: 0.001, opacity: 0.3, ease: "power2.out" });
      }
    });
  });
});
</script>

<template>
  <div class="relative flex justify-center items-center min-h-screen">
    <h1 ref="textRef" class="relative mx-auto mt-2 uppercase text-4xl font-bold tracking-tight text-gray-950 sm:text-7xl cursor-pointer">
      REAL DESIGNS BY REAL ARTISTS FOR REAL PEOPLE
    </h1>
  </div>
</template>

<style>
/* Désactive le curseur natif pour voir l'effet */
body {
  /* cursor: none; */
}
</style> -->

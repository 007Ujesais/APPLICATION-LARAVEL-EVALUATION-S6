@extends('admin.Layouts.GuestLayout')

@section('title', 'Security Page Admin')

@section('content')
<div class="bg-white dark:bg-gray-800 flex flex-col items-center w-80 text-center p-6 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold mb-4">Enter your PIN code for administration</h2>

    <form id="pinForm" method="POST" action="{{ route('admin-Login.post') }}">
        @csrf
        <input type="hidden" id="pin_code" name="pin_code">
    
        <div x-data="pincode()" class="flex space-x-2 justify-center">
            <template x-for="i in length" :key="i">
                <input 
                    class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    type="text" 
                    maxlength="1"
                    @input="updatePin()"
                    @keydown="type($event, i)"
                    @paste.prevent="paste($event)" 
                    x-model="input[i-1]"
                    :id="'pin' + i"
                    placeholder="0"
                    :autofocus="i == 1"
                >
            </template>
        </div>
    </form>

    @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

<script>
function pincode() {
    return {
        length: 4,
        input: ["", "", "", ""], 
        updatePin() {
            document.getElementById('pin_code').value = this.input.join(""); 
        },
        paste(event) {
            let pasted = event.clipboardData.getData("text").replace(/\D/g, "").substring(0, this.length);
            if (pasted.length === this.length) {
                this.input = pasted.split("");
                this.updatePin();
                this.submitForm();
            }
        },
        type(event, index) {
            if (event.key === "Backspace") {
                if (this.input[index - 1] === "") {
                    this.goto(index - 1);
                } else {
                    this.input[index - 1] = "";
                }
            } else {
                let key = event.key.replace(/\D/g, "");
                if (key !== "") {
                    this.input[index - 1] = key;
                    this.$nextTick(() => this.goto(index + 1));
                }
            }
            this.updatePin();

            if (this.input.every(num => num !== "")) {
                this.submitForm();
            }
        },
        goto(n) {
            if (n > this.length) return;
            let el = document.querySelector(`#pin${n}`);
            if (el) el.focus();
        },
        submitForm() {
            this.$nextTick(() => {
                let form = document.querySelector("#pinForm");
                if (form) form.submit(); 
            });
        }
    };
}

</script>

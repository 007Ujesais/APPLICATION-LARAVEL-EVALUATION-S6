<template>
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ new Date().getFullYear() }} Education Projet. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Nantenaina</a>
                <a href="#">DES S6</a>
                <a href="#">ETU2898</a>
            </div>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
.footer {
    text-align: left;
    padding: 20px;
    width: 100%;
    .footer-links {
        margin-top: 10px;
        a {
            margin: 0 10px;
            text-decoration: none;
        }
    }
    .footer-content {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}
</style>

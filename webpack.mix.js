const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [tailwindcss]
);

mix.browserSync({
    proxy: "http://localhost:8000", // URL do seu servidor Laravel
    files: [
        "resources/views/**/*.blade.php", // Monitora arquivos Blade
        "resources/css/**/*.css", // Monitora arquivos CSS
        "resources/js/**/*.js", // Monitora arquivos JS
    ],
});

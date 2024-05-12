import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import tsconfigPaths from "vite-tsconfig-paths";
// import resolve from "vite-plugin-resolve";

export default defineConfig({
	plugins: [
		laravel({
			input: ["resources/sass/main.scss"],
			refresh: true,
		}),
		// tsconfigPaths(),
		// resolve({
		// 	"./resources/helpers/dictionary": () =>
		// 		"./resources/helpers/dictionary.js",
		// }),
	],
});

// "resources/ts/app.ts",

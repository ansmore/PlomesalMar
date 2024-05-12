export default {
	preset: "ts-jest",
	testEnvironment: "jest-environment-jsdom",
	roots: ["<rootDir>/tests/Ts", "<rootDir>/resources/ts"],
	testMatch: ["**/*.(test|spec).ts"],
	collectCoverage: false,
	coverageDirectory: "coverage",
	coveragePathIgnorePatterns: ["/node_modules/"],
	collectCoverageFrom: [
		"resources/ts/**/*.{ts,tsx}",
		"!**/node_modules/**",
		"!**/*.d.ts",
	],
	transform: {
		"^.+\\.ts$": "ts-jest",
	},
};

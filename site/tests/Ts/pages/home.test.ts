// import { main } from "../../../resources/ts/pages/home";
// import * as dictionary from "../../../resources/ts/helpers/dictionary";

// jest.mock("../../../resources/ts/helpers/dictionary", () => ({
// 	loadText: jest.fn().mockResolvedValue(undefined),
// }));

// describe("Home Page Main Function", () => {
// 	test("should call loadText function", async () => {
// 		await main();
// 		expect(dictionary.loadText).toHaveBeenCalled();
// 	});
// });

// describe("Home Page Main Function", () => {
// 	let spyLoadText: jest.SpyInstance;

// 	beforeEach(() => {
// 		// Estableix un spy en loadText per observar les crides sense afectar la seva execució
// 		spyLoadText = jest.spyOn(dictionary, "loadText");
// 	});

// 	afterEach(() => {
// 		// Neteja el spy després de cada test per evitar interferències
// 		spyLoadText.mockRestore();
// 	});

// 	test("should call loadText function", async () => {
// 		await main();
// 		expect(spyLoadText).toHaveBeenCalled();
// 	});
// });

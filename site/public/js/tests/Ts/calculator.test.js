import { add, subtract, multiply, divide, } from "../../../site/resources/ts/calculator";
describe("Calculator", () => {
    describe("add function", () => {
        test("should add two numbers correctly", () => {
            // Arrange (Given)
            const num1 = 5;
            const num2 = 3;
            const expected = 8;
            // Act (When)
            const result = add(num1, num2);
            // Assert (Then)
            expect(result).toBe(expected);
        });
    });
    describe("subtract function", () => {
        test("should subtract two numbers correctly", () => {
            const num1 = 5;
            const num2 = 3;
            const expected = 2;
            const result = subtract(num1, num2);
            expect(result).toBe(expected);
        });
    });
    describe("multiply function", () => {
        test("should multiply two numbers correctly", () => {
            const num1 = 5;
            const num2 = 3;
            const expected = 15;
            const result = multiply(num1, num2);
            expect(result).toBe(expected);
        });
    });
    describe("divide function", () => {
        test("should divide two numbers correctly", () => {
            const num1 = 6;
            const num2 = 3;
            const expected = 2;
            const result = divide(num1, num2);
            expect(result).toBe(expected);
        });
        test("should throw an error when dividing by zero", () => {
            const num1 = 6;
            const num2 = 0;
            expect(() => divide(num1, num2)).toThrow("Cannot divide by zero");
        });
    });
});

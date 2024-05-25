import { add } from "../../../site/resources/ts/calculator";
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
});

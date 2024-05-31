export function add(a, b) {
    return a + b;
}
export function subtract(a, b) {
    return a - b;
}
export function multiply(a, b) {
    return a * b;
}
// return union types -> number | string
export function divide(a, b) {
    if (b === 0) {
        throw new Error("Cannot divide by zero");
        // return "Cannot divide by zero";
    }
    return a / b;
}

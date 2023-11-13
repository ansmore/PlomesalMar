var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
export const loadDictionary = (language, page) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // console.log("page:", page, "language:", language);
        // let languageCode = language;
        const response = yield fetch(`./dictionary/${language}/${language}_${page}.json`);
        if (!response.ok) {
            throw new Error(`Error loading the language ${language}.`);
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading json", error);
        throw error;
    }
});
// const abailableLanguages = ["en", "es"];
export const loadAbailablesLanguages = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./dictionary/listLanguages.json`);
        if (!response.ok) {
            throw new Error("Error loading white language list");
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading white language list", error);
        throw error;
    }
});
export const loadAbailablesFiles = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./dictionary/listPages.json`);
        if (!response.ok) {
            throw new Error("Error loading white page list");
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading white page list", error);
        throw error;
    }
});

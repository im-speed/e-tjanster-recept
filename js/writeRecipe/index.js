import createNode from "../createNode.js";
import createIngredientSelect from "./ingredientSelect.js";

const ingredientList = document.querySelector("#ingredients-list");
const addIngredientButton = document.querySelector("#add-ingredient");

function createIngredientOptions() {
    const ingredientSelect = createIngredientSelect();
    const ingredientWeight = createNode("input", {
        className: "ingredient-weight",
        type: "number",
        min: "0",
        placeholder: "Weight (g)",
    });
    const removeButton = createNode("button", { className: "button", textContent: "-" });

    const ingredientOption = createNode("div", {
        children: [ingredientSelect, ingredientWeight, removeButton],
    });

    removeButton.addEventListener("click", () => {
        ingredientOption.remove();
    });

    return ingredientOption;
}

addIngredientButton.addEventListener("click", () => {
    ingredientList.appendChild(createIngredientOptions());
});

ingredientList.appendChild(createIngredientOptions());

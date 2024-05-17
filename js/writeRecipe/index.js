import createNode from "../createNode.js";
import createIngredientSelect from "./ingredientSelect.js";

const ingredientList = document.querySelector("#ingredients-list");
const addIngredientButton = document.querySelector("#add-ingredient");

const ingredients = [];

function addIngredient() {
    const index = ingredients.length;

    const ingredientSelect = createIngredientSelect(`ingredient-${index}`);
    const ingredientWeight = createNode("input", {
        className: "ingredient-weight",
        type: "number",
        name: `ingredient-weight-${index}`,
        min: "0",
        placeholder: "Weight (g)",
    });
    const removeButton = createNode("button", {
        textContent: "-",
        className: "button",
        type: "button",
    });

    const ingredientOption = createNode("div", {
        children: [ingredientSelect, ingredientWeight, removeButton],
    });

    removeButton.onclick = () => removeIngredient(index);

    ingredients.push(ingredientOption);
    ingredientList.appendChild(ingredientOption);
}

function removeIngredient(index) {
    ingredients[index].remove();
    ingredients.splice(index, 1);

    ingredients.slice(index).forEach((ingredient, indexAdd) => {
        const id = ingredient.querySelector(".ingredient-id");
        const weight = ingredient.querySelector(".ingredient-weight");
        const removeButton = ingredient.querySelector("button");

        id.name = `ingredient-${index + indexAdd}`;
        weight.name = `ingredient-weight-${index + indexAdd}`;

        removeButton.onclick = () => removeIngredient(index + indexAdd);
    });
}

addIngredientButton.addEventListener("click", addIngredient);

addIngredient();

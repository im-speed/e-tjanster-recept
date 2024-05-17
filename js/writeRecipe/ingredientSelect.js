import { livsmedelsverket } from "../api/paths.js";
import createNode from "../createNode.js";

let ingredients = [];

function filterIngredients(ingredients, searchValue, maxIngredients) {
    const filteredingredients = [];

    for (const ingredient of ingredients) {
        if (ingredient.namn.toLowerCase().includes(searchValue.toLowerCase())) {
            filteredingredients.push(ingredient);
            maxIngredients--;
        }

        if (maxIngredients < 1) {
            break;
        }
    }

    return filteredingredients;
}

function listIngredients(container, ingredients, searchBar, idInput) {
    ingredients.forEach((ingredient) => {
        const ingredientButton = createNode("button", { textContent: ingredient.namn });

        ingredientButton.addEventListener("click", () => {
            searchBar.value = ingredient.namn;
            idInput.value = ingredient.nummer;
            container.textContent = "";
        });

        container.appendChild(ingredientButton);
    });
}

export default function createIngredientSelect(name) {
    const searchBar = createNode("input", {
        className: "ingredients-search",
        type: "search",
        placeholder: "Ingredient",
    });
    const resultContainer = createNode("div", { className: "ingredients-select dropdown-list" });
    const hiddenValue = createNode("input", {
        className: "ingredient-id",
        type: "hidden",
        name,
    });

    searchBar.addEventListener("keyup", () => {
        const searchValue = searchBar.value;

        resultContainer.textContent = "";
        hiddenValue.value = null;

        if (searchValue.length > 1 && ingredients) {
            const filteredingredients = filterIngredients(ingredients, searchValue, 200);

            listIngredients(resultContainer, filteredingredients, searchBar, hiddenValue);
        }
    });

    return createNode("div", {
        className: "dropdown ingredients-select",
        children: [hiddenValue, searchBar, resultContainer],
    });
}

fetch(livsmedelsverket.listAll)
    .then((res) => res.json())
    .then((json) => (ingredients = json.livsmedel))
    .catch((err) => console.error(err));

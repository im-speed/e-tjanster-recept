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

function listIngredients(container, ingredients, searchBar) {
    ingredients.forEach((ingredient) => {
        const ingredientButton = createNode("button", { textContent: ingredient.namn });

        ingredientButton.addEventListener("click", () => {
            searchBar.value = ingredient.namn;
            searchBar.dataset.ingredientId = ingredient.nummer;
            container.textContent = "";
        });

        container.appendChild(ingredientButton);
    });
}

export default function createIngredientSelect(name) {
    const searchBar = createNode("input", {
        className: "ingredients-search",
        name,
        type: "search",
        placeholder: "Ingredient",
    });
    const resultContainer = createNode("div", { className: "ingredients-select dropdown-list" });

    searchBar.addEventListener("keyup", () => {
        const searchValue = searchBar.value;

        resultContainer.textContent = "";

        if (searchValue.length > 1 && ingredients) {
            const filteredingredients = filterIngredients(ingredients, searchValue, 200);

            listIngredients(resultContainer, filteredingredients, searchBar);
        }
    });

    return createNode("div", {
        className: "dropdown ingredients-select",
        children: [searchBar, resultContainer],
    });
}

fetch(livsmedelsverket.listAll)
    .then((res) => res.json())
    .then((json) => (ingredients = json.livsmedel))
    .catch((err) => console.error(err));

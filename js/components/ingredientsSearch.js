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
            container.textContent = "";
        });
        container.appendChild(ingredientButton);
    });
}

document.querySelectorAll(".ingredients-list").forEach((ingredientList) => {
    const searchBar = ingredientList.querySelector(".ingredients-search");
    const resultContainer = ingredientList.querySelector(".ingredients-filtered");

    searchBar.addEventListener("keyup", () => {
        const searchValue = searchBar.value;

        resultContainer.textContent = "";

        if (searchValue.length > 1 && ingredients) {
            const filteredingredients = filterIngredients(ingredients, searchValue, 200);

            listIngredients(resultContainer, filteredingredients, searchBar);
        }
    });
});

fetch(livsmedelsverket.listAll)
    .then((res) => res.json())
    .then((json) => (ingredients = json.livsmedel))
    .catch((err) => console.error(err));

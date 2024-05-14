import { livsmedelsverket } from "../api/paths.js";
import createNode from "../createNode.js";

let ingredients = [];

function filterIngredients(ingredients, searchValue) {
    const filteredingredients = [];

    for (const ingredient of ingredients) {
        if (ingredient.namn.toLowerCase().includes(searchValue.toLowerCase())) {
            filteredingredients.push(ingredient);
        }
    }

    return filteredingredients;
}

function listingredients(container, ingredients) {
    ingredients.forEach((ingredient) => {
        container.appendChild(
            createNode("button", { textContent: ingredient.namn })
        );
    });
}

document.querySelectorAll(".ingredients-list").forEach((ingredientList) => {
    const searchBar = ingredientList.querySelector(".ingredients-search");
    const resultContainer = ingredientList.querySelector(
        ".ingredients-filtered"
    );

    searchBar.addEventListener("keyup", () => {
        const searchValue = searchBar.value;

        resultContainer.textContent = "";

        if (searchValue.length > 0 && ingredients) {
            const filteredingredients = filterIngredients(
                ingredients,
                searchValue
            );

            console.log(filteredingredients.length);

            listingredients(resultContainer, filteredingredients);
        }
    });
});

fetch(livsmedelsverket.listAll)
    .then((res) => res.json())
    .then((json) => (ingredients = json.livsmedel))
    .catch((err) => console.error(err));

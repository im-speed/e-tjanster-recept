import { livsmedelsverket } from "../api/paths.js";
import createNode from "../createNode.js";

const ingredientList = document.querySelectorAll(".waiting-ingredient");

function createIngredient(data, weight) {
    return createNode("li", {
        className: "recipe-ingredient",
        children: [
            createNode("span", { textContent: data.namn }),
            createNode("span", { textContent: `${weight} g` }),
        ],
    });
}

ingredientList.forEach((ingredient) => {
    fetch(livsmedelsverket.byId(ingredient.dataset.number))
        .then((res) => res.json())
        .then((json) => {
            ingredient.replaceWith(
                createIngredient(json, ingredient.dataset.weight)
            );
        })
        .catch((err) => console.error(err));
});

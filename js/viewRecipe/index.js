import { livsmedelsverket } from "../api/paths.js";
import createNode from "../createNode.js";
import { fromGram } from "../scaleWeight.js";
import sumNutrition from "./sumNutrition.js";

const ingredients = document.querySelectorAll(".waiting-ingredient");
const nutritionList = document.querySelector("#nutrition-list");

function createIngredient(data, weight) {
    const formattedWeight = fromGram(weight);
    return createNode("li", {
        className: "recipe-ingredient",
        children: [
            createNode("span", { textContent: data["namn"] }),
            createNode("span", {
                textContent: `${formattedWeight.weight} ${formattedWeight.unit}`,
            }),
        ],
    });
}

function createNutrient(nutrient) {
    const formattedWeight =
        nutrient.unit === "g" ? fromGram(nutrient.value) : null;

    const weight = formattedWeight ? formattedWeight.weight : nutrient.value;
    const unit = formattedWeight ? formattedWeight.unit : nutrient.unit;

    return createNode("li", {
        className: "recipe-ingredient",
        children: [
            createNode("span", { textContent: nutrient.name }),
            createNode("span", {
                textContent: `${weight} ${unit}`,
            }),
        ],
    });
}

const ingredientsData = [];

ingredients.forEach((ingredient) => {
    const id = ingredient.dataset.number;
    const weight = ingredient.dataset.weight;

    ingredientsData.push({ id, weight });

    fetch(livsmedelsverket.byId(id))
        .then((res) => res.json())
        .then((json) => {
            ingredient.replaceWith(createIngredient(json, weight));
        })
        .catch((err) => console.error(err));
});

sumNutrition(ingredientsData).then((nutrients) =>
    nutrients
        .filter((nutrient) => nutrient.unit !== "%") // The current sum function only works on addative values
        .sort((a, b) => a.name > b.name)
        .forEach((nutrient) => {
            nutritionList.appendChild(createNutrient(nutrient));
        })
);

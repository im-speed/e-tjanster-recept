import { livsmedelsverket } from "../api/paths.js";
import { toGram } from "../scaleWeight.js";

async function getNutrition(ingredientID, weight) {
    let nutrients;

    try {
        const res = await fetch(livsmedelsverket.nutrition(ingredientID));
        nutrients = await res.json();
    } catch (error) {
        return console.error(error);
    }

    nutrients = nutrients.map((nutrient) => {
        const obj = {
            name: nutrient["namn"],
            value: nutrient["varde"],
            unit: nutrient["enhet"],
        };

        const gramValue =
            (toGram(nutrient["varde"], nutrient["enhet"]) * weight) /
            nutrient["viktGram"];

        if (!isNaN(gramValue)) {
            obj.value = gramValue;
            obj.unit = "g";
        }

        return obj;
    });

    return nutrients;
}

function combineNutrition(nutrition1 = [], nutrition2 = []) {
    if (nutrition1.length !== nutrition2.length) {
        return console.error(
            "Cannot combine two nutrition lists of different length"
        );
    }

    return nutrition1.map((nutrient1, index) => {
        const nutrient2 = nutrition2[index];

        if (nutrient1.name === nutrient2.name)
            nutrient1.value += nutrient2.value;

        return nutrient1;
    });
}

export default async function sumNutrition(ingredients) {
    let sum = [];

    let first = true;
    for (const ingredient of ingredients) {
        const nutrition = await getNutrition(ingredient.id, ingredient.weight);

        if (first) {
            sum = nutrition;
            first = false;
        } else {
            sum = combineNutrition(sum, nutrition);
        }
    }

    return sum;
}

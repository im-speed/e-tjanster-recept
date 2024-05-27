import { theMealDB } from "../api/paths.js";
import createNode from "../createNode.js";

const container = document.querySelector("#food_row_container");

let categories;
let recipes;

async function fetchCategories() {
    let json;

    try {
        const res = await fetch(theMealDB.categories);
        json = await res.json();
    } catch {
        console.error("Failed to fetch TheMealDB meal categories.");
    }

    return json;
}

async function fetchRecipes() {
    let json;

    try {
        const res = await fetch("get-recipes.php");
        json = await res.json();
    } catch {
        console.error("Failed to fetch TheMealDB meal categories.");
    }

    return json;
}

function createCategoryRow(category) {
    const recipes = category["recipes"].map((recipe) =>
        createNode("a", {
            href: `recipe.php?id=${recipe["id"]}`,
            children: [
                createNode("img", {
                    className: "food_preview",
                    src: `img/uploads/${recipe["imgHref"]}`,
                    alt: recipe["name"],
                }),
            ],
        })
    );

    const row = createNode("div", {
        className: "food_row",
        children: [
            createNode("h2", { textContent: category["strCategory"] }),
            ...recipes,
        ],
    });

    return row;
}

fetchCategories().then((res) => {
    categories = res["categories"];

    categories = categories.map((category) => {
        category["recipes"] = [];
        return category;
    });

    fetchRecipes().then((res) => {
        recipes = res;

        recipes.forEach((recipe) => {
            const matchingCategory = categories.find(
                (category) => category["idCategory"] == recipe["category"]
            );

            if (matchingCategory) {
                matchingCategory["recipes"].push(recipe);
            }
        });

        categories.forEach((category) => {
            if (category["recipes"].length) {
                container.append(createCategoryRow(category));
            }
        });
    });
});

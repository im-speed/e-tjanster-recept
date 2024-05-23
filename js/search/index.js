import { theMealDB } from "../api/paths.js";
import createNode from "../createNode.js";
import { getQueryVariable } from "../urlFunctions.js";

const resultContainer = document.querySelector("#api-search-results");

const query = getQueryVariable("q");

function createSearchResults(recipes) {
    resultContainer.textContent = "";

    recipes.forEach((recipe) => {
        const data = {
            id: recipe["idMeal"],
            title: recipe["strMeal"],
            desc: recipe["strInstructions"],
            img: recipe["strMealThumb"],
        };

        const searchResult = createNode("a", {
            className: "search-result",
            href: `themealdb.php?id=${data.id}`,
            children: [
                createNode("img", {
                    className: "search-result-thumb",
                    src: data.img,
                    alt: "Recipe thumbnail",
                }),
                createNode("div", {
                    children: [
                        createNode("div", {
                            textContent: data.title,
                            className: "search-result-title",
                        }),
                        createNode("p", {
                            textContent: data.desc,
                            className: "search-result-instructions",
                        }),
                    ],
                }),
            ],
        });

        resultContainer.appendChild(searchResult);
    });
}

function setMessage(text) {
    resultContainer.appendChild(createNode("p", { textContent: text }));
}

fetch(theMealDB.byName(query))
    .then((res) => res.json())
    .then((json) => createSearchResults(json["meals"]))
    .catch(() => setMessage("Could not access TheMealDB"));

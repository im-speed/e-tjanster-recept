const theMealDB = {
    categories: "https://www.themealdb.com/api/json/v1/1/categories.php",
    byId: (id) => `https://www.themealdb.com/api/json/v1/1/search.php?s=${id}`,
    byingredient: (ingredient) =>
        `https://www.themealdb.com/api/json/v1/1/search.php?s=${ingredient}`,
};

const livsmedelsverket = {
    listAll:
        "https://corsproxy.io/?https://dataportal.livsmedelsverket.se/livsmedel/api/v1/livsmedel?offset=0&limit=9999&sprak=2",
    byId: (id) =>
        `https://corsproxy.io/?https://dataportal.livsmedelsverket.se/livsmedel/api/v1/livsmedel/${id}?sprak=2`,
};

export { theMealDB, livsmedelsverket };

export default function createNode(tagName, { children = [], ...attributes }) {
    if (typeof tagName !== "string")
        throw new TypeError("Parameter tagName was not type: string");

    const node = document.createElement(tagName);

    Object.entries(attributes).forEach(([attribute, value]) => {
        try {
            node[attribute] = value;
        } catch (error) {
            console.error(error);
        }
    });

    children.forEach((child) => node.appendChild(child));

    return node;
}

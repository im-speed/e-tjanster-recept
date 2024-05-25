const units = {
    µg: 0.000_001,
    mg: 0.001,
    g: 1,
    kg: 1_000,
    t: 1_000_000,
    kcal: 1,
    kJ: 1,
};

function toGram(weight, unit) {
    return weight * units[unit];
}

function divide(numerator, denominator) {
    return Math.round((1000000 * numerator) / denominator) / 1000000;
}

function fromGram(weight = 1) {
    const unitList = Object.entries(units);
    const result = { weight: weight, unit: "g" };

    let previous;
    let index = 0;

    for (const [unit, value] of unitList) {
        if (index == unitList.length - 1 && weight >= value) {
            // largest unit
            result.weight = divide(weight, value);
            result.unit = unit;
            break;
        }

        if (value > weight && previous) {
            result.weight = divide(weight, previous.value);
            result.unit = previous.unit;
            break;
        }

        previous = { unit, value };
        index++;
    }

    return result;
}

export { toGram, fromGram };

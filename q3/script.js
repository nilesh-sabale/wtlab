let arr = [];

// Load array
function loadArray() {
    let input = document.getElementById("arrayInput").value;
    arr = input.split(",").map(Number);
    document.getElementById("currentArray").innerText = arr;
}

// Reverse
function reverseArray() {
    let reversed = [...arr].reverse();
    document.getElementById("reverseResult").innerText = reversed;
}

// Bubble Sort
function bubbleSort(a, asc=true) {
    let n = a.length;
    let arrCopy = [...a];

    for (let i = 0; i < n-1; i++) {
        for (let j = 0; j < n-i-1; j++) {
            if (asc ? arrCopy[j] > arrCopy[j+1] : arrCopy[j] < arrCopy[j+1]) {
                let temp = arrCopy[j];
                arrCopy[j] = arrCopy[j+1];
                arrCopy[j+1] = temp;
            }
        }
    }
    return arrCopy;
}

// Selection Sort
function selectionSort(a, asc=true) {
    let arrCopy = [...a];

    for (let i = 0; i < arrCopy.length; i++) {
        let idx = i;
        for (let j = i+1; j < arrCopy.length; j++) {
            if (asc ? arrCopy[j] < arrCopy[idx] : arrCopy[j] > arrCopy[idx]) {
                idx = j;
            }
        }
        [arrCopy[i], arrCopy[idx]] = [arrCopy[idx], arrCopy[i]];
    }
    return arrCopy;
}

// Insertion Sort
function insertionSort(a, asc=true) {
    let arrCopy = [...a];

    for (let i = 1; i < arrCopy.length; i++) {
        let key = arrCopy[i];
        let j = i - 1;

        while (j >= 0 && (asc ? arrCopy[j] > key : arrCopy[j] < key)) {
            arrCopy[j+1] = arrCopy[j];
            j--;
        }
        arrCopy[j+1] = key;
    }
    return arrCopy;
}

// Sort main
function sortArray() {
    let method = document.getElementById("sortMethod").value;
    let order = document.getElementById("sortOrder").value;
    let asc = order === "asc";

    let result;

    if (method === "bubble") result = bubbleSort(arr, asc);
    else if (method === "selection") result = selectionSort(arr, asc);
    else result = insertionSort(arr, asc);

    document.getElementById("sortResult").innerText = result;
}

// Linear Search
function linearSearch(a, key) {
    for (let i = 0; i < a.length; i++) {
        if (a[i] == key) return i;
    }
    return -1;
}

// Binary Search
function binarySearch(a, key) {
    let arrCopy = [...a].sort((x,y)=>x-y);
    let low = 0, high = arrCopy.length - 1;

    while (low <= high) {
        let mid = Math.floor((low + high)/2);

        if (arrCopy[mid] == key) return mid;
        else if (arrCopy[mid] < key) low = mid + 1;
        else high = mid - 1;
    }
    return -1;
}

// Search main
function searchArray() {
    let method = document.getElementById("searchMethod").value;
    let key = Number(document.getElementById("searchValue").value);

    let index;

    if (method === "linear") {
        index = linearSearch(arr, key);
    } else {
        index = binarySearch(arr, key);
    }

    document.getElementById("searchResult").innerText =
        index !== -1 ? "Found at index: " + index : "Not Found";
}
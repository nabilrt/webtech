var fs = require("fs");
var text = fs.readFileSync("dictionary.txt");
var textByLine = text.split("\n");

document.write(textByLine[0]);
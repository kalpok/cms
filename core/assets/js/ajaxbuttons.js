GetStyleClass("section.content a").pointerEvents = "none";

function GetStyleClass(className) {
    for (var i = 0; i < document.styleSheets.length; i++) {
        var styleSheet = document.styleSheets[i];
        var rules = styleSheet.cssRules || styleSheet.rules;
        for (var j = 0; j < rules.length; j++) {
            var rule = rules[j];
            if (rule.selectorText === className) {
                return rule.style;
            }
        }
    }
    return 0;
}

(function (Drupal) {
    Drupal.behaviors.WebAnalyticsBehavior = {
      attach: function (context, settings) {
        var referenceId = Drupal.settings.web_analytics.id,
            referenceType = Drupal.settings.web_analytics.type,
            referenceName = Drupal.settings.web_analytics.name;
        if (referenceId && referenceType && referenceName && Drupal.settings.web_analytics.path) {
            callAjaxforProxy(referenceId, referenceType, referenceName, Drupal.settings.web_analytics.path);
        }
        else if (referenceId && referenceType && referenceName) {
            callAjax(referenceId, referenceType, referenceName);
        }
      }
    };
})(Drupal);

function callAjax(id, type, name) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/admin/web-analytics/stats/using-ajax", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&type=" + type + "&name=" + name);
}

function callAjaxforProxy(id, type, name, path) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", path, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&type=" + type + "&name=" + name);
}
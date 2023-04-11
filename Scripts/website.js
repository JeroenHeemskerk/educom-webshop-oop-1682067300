function makeDetailLink(key) {
    let ids = key.split("_");
    console.log(ids);
    return "index.php?page=detail&id="+ids[0]+"&size="+ids[1]+"&material="+ids[2]+"&price="+ids[3]
}

function changeDetailLink(key) {
    let ids = key.split("_");
    let aTag = document.getElementById("details_" + ids[0]);
    aTag.href = makeDetailLink(key);

}
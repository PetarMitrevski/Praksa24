let tableOverall = document.getElementById("table_overall")
let tableHome = document.getElementById("table_home")
let tableAway = document.getElementById("table_away")
const buttons = document.querySelectorAll(".clubs__buttons_stats button")
const rows = document.querySelectorAll(".clubs__table-overall tr")

tableHome.style.display = "none"
tableAway.style.display = "none"
buttons[0].style.background = "#2e093d"
buttons[0].style.color = "white" 


buttons.forEach((button, index) => {
   
    if(index === 0)
    button.addEventListener("click", ()=>{

    tableOverall.style.display = "table"
    tableHome.style.display = "none"
    tableAway.style.display = "none"
    buttons[index].style.background = "#2e093d"
    buttons[index].style.color = "white"
    buttons[index + 1].style.background = "white"
    buttons[index + 1].style.color = "#2e093d"
    buttons[index + 2].style.background = "white"
    buttons[index + 2].style.color = "#2e093d"

    });
    
    else if(index === 1)
    button.addEventListener("click", ()=>{

    tableHome.style.display = "table"
    tableAway.style.display = "none"
    tableOverall.style.display = "none"
    buttons[index].style.background = "#2e093d"
    buttons[index].style.color = "white"
    buttons[index - 1].style.background = "white"
    buttons[index - 1].style.color = "#2e093d"
    buttons[index + 1].style.background = "white"
    buttons[index + 1].style.color = "#2e093d"
    
    });
    
    else {
    button.addEventListener("click", ()=>{
        
    tableAway.style.display = "table"
    tableHome.style.display = "none"
    tableOverall.style.display = "none"
    buttons[index].style.background = "#2e093d"
    buttons[index].style.color = "white"
    buttons[index - 1].style.background = "white"
    buttons[index - 1].style.color = "#2e093d"
    buttons[index - 2].style.background = "white"
    buttons[index - 2].style.color = "#2e093d"
    
    })
}

})

rows[1].style.borderTop = "2px solid royalblue"
rows[3].style.borderBottom = "2px solid lime"
rows[6].style.borderBottom = "2px solid lime"
rows[18].style.borderTop = "2px solid red"

history.pushState(null, null, null);
window.addEventListener('popstate', function () {
    history.pushState(null, null, null);
});





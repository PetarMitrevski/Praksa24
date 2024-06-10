let tableOverall = document.getElementById("table_overall")
let tableHome = document.getElementById("table_home")
let tableAway = document.getElementById("table_away")
const buttons = document.querySelectorAll(".btn-group button")

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
    
    else
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
})
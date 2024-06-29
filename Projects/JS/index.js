let tableOverall = document.getElementById("table_overall")
let tableHome = document.getElementById("table_home")
let tableAway = document.getElementById("table_away")
const buttons = document.querySelectorAll(".btn-group button")
const tableOverallRows = document.querySelectorAll("#table_overall tr")



for(let i = 0; i < tableOverallRows.length; i++){

    if((i >= 1) && (i < 4)){
    tableOverallRows[i].style.background = 'royalblue'
    }

    else if((i > 3) && (i < 6)){
    tableOverallRows[i].style.background = 'lime'
    }

    else if((i >= 18) && (i < 21)){
        tableOverallRows[i].style.background = 'red'
        
    }
    


}













/*


*/








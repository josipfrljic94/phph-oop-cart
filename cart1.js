const cartRow= document.querySelector("#cart-row");

// Fetch ALL AJAX

const fetchAllUsers=async ()=>{
    const data = await fetch("action.php?cart=1",{
        method: "GET",
    });
    const response = await data.text();
    console.log(response,'tu sam');
    cartRow.innerHTML=(response);
};
 fetchAllUsers();



cartRow.addEventListener("click",async(e)=>{
    if(e.target && e.target.matches('button.addBtn')){
        let element= e.target.parentElement;
        e.preventDefault();
       let gcode=(element.children[1].getAttribute('value'));

       

const xhr = new XMLHttpRequest();
xhr.open("POST", 'action.php', true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        console.log(this.responseText);
        fetchAllUsers();
    }
}
xhr.send(`gcode=${gcode}&increase=1`);

    }
})

cartRow.addEventListener("click",async(e)=>{
    if(e.target && e.target.matches('button.deleteBtn')){
        let element= e.target.parentElement;
        e.preventDefault();
       let gcode=(element.children[1].getAttribute('value'));

       

const xhr = new XMLHttpRequest();
xhr.open("POST", 'action.php', true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function() { // Call a function when the state changes.
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        console.log(this.responseText);
        fetchAllUsers();
    }
}
xhr.send(`dcode=${gcode}&decrease=1`);

    }
})


const g_container= document.getElementById("gcontainer");
const btnB= document.getElementById("btn-buy");


 const  fetchAllProducts= async()=>{
    const data = await fetch("action.php?read=1",{
        method:"GET",
    });
    const response= await data.text();
    // console.log(response);
    g_container.innerHTML=(response);

 }

 fetchAllProducts();







 


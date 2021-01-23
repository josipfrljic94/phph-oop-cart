const guitarRow= document.getElementById("guitar-row");
const sessionAlert= document.getElementById('session-box');




guitarRow.addEventListener("click",async(e)=>{
    if(e.target && e.target.matches('button.addtocartbtn')){
        let element= e.target.parentElement;
        e.preventDefault();
           const formData= new FormData(element);
    // formData.append("add",1);
        console.log(element);
        console.log(element.checkValidity());
        if(element.checkValidity()===false){
                    e.preventDefault();
                    e.stopPropagation();
                    // element.classList.add("was-validated");
                    console.log('sranje tu');
                    return false;
                }else{
                    const data= await fetch('action.php',{
                        method:'POST',
                        body:formData,
                    });
                    const response= await data.text();
                    console.log(response);
            }
    }
})








// guitarRow.addEventListener("click",async(e)=>{
//     if(e.target && e.target.matches('button.addtocartbtn')){

//         let element= e.target.parentElement;
    // e.preventDefault();
    // const formData= new FormData(element);
    // formData.append("add",1);
        // console.log(element);
    // e.stopPropagation();
//     if(element.checkValidity()===false){
//         e.preventDefault();
//         e.stopPropagation();
//         // element.classList.add("was-validated");
//         console.log('sranje tu');
//         return false;
//     }else{
//         const data= await fetch('action.php',{
//             method:'POST',
//             body:formData,
//         });
//         const response= await data.text();
//         console.log(response);
// }
// }
// })
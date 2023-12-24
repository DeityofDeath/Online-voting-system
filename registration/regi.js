let input1=document.querySelector('.name')
let input2=document.querySelector('.mobile')
let input3=document.querySelector('.password')
let input4=document.querySelector('.cpass')
let input5=document.querySelector('.add')
let btn=document.querySelector('.btn')
let form=document.querySelector('.form')
form.addEventListener("submit",(event)=>{
    event.preventDefault();
        let name=(input1.value)
        let mobile=(input2.value)
        let password=(input3.value)
        let confirmpass=(input4.value)
        let address=(input1.value)
    console.log({name,mobile,password,confirmpass,address})
    alert('Successfully registered....Redirecting to login page')
})
btn.addEventListener("click",redirectFunction)
function redirectFunction(){
    setTimeout(()=>{
        window.location.href = "../loginv/loginv.html";
    },5000)
}
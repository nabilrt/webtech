
function generate_question(){
    
    var l=Math.floor(Math.random()*6)+3;
    var alphabet = "abcdefghijklmnopqrstuvwxyz";
    var x=alphabet[Math.floor(Math.random() * alphabet.length)];

    if(document.getElementById("easy").checked==true){
        question="Write a "+l+" letter word which has '"+x+"' in it";
        document.getElementById("diffError").innerHTML="";
        document.getElementById("res").innerHTML="";
        document.getElementById("ans").value="";
        document.getElementById("answer").style.color="#4B0082";
        document.getElementById("answer").innerHTML=question;
    }else if(document.getElementById("hard").checked==true){
        document.getElementById("diffError").innerHTML="";
        document.getElementById("res").innerHTML="";
        document.getElementById("ans").value="";
        question="Write a "+l+" letter word which starts with or ends with '"+x+"'";
        document.getElementById("answer").style.color="#4B0082";
        document.getElementById("answer").innerHTML=question;
    }
    else if(document.getElementById("easy").checked==false && document.getElementById("hard").checked==false){
        document.getElementById("diffError").innerHTML="Please Choose a Difficulty";
    }
   
}

function results(){

    var r=document.getElementById("ans").value;

    var x=Number.parseInt(question[8]);

    var y=question[33];

    var a=question[54];

    if(document.getElementById("easy").checked==true){
        if(r.length==x && (r.includes(y)|| r.includes(y.toUpperCase()))){
        
            document.getElementById("res").style.color="green";
            document.getElementById("res").innerHTML="Your answer is correct";
        }
        else{
    
            document.getElementById("res").style.color="red";
            document.getElementById("res").innerHTML="Your answer is wrong";
        }
    }
    else if(document.getElementById("hard").checked==true){

        if(r.length==x && (r[0]==a|| r[r.length-1]==a || r[0]==a.toUpperCase() || r[r.length-1]==a.toUpperCase())){
        
            document.getElementById("res").style.color="green";
            document.getElementById("res").innerHTML="Your answer is correct";
        }
        else{
    
            document.getElementById("res").style.color="red";
            document.getElementById("res").innerHTML="Your answer is wrong";
        }

    }
}

import { useState } from "react";
import { useNavigate } from "react-router";

const SignUp = () =>{
    const [email,setEmail] = useState("");
    const [password, setPassword] =useState("");
    const [name, setName] =useState("");
    const [lastName, setLastName] = useState("");


    const navigate = useNavigate();

    const registration = async (e) => {
        e.preventDefault();
        try{
            const response = fetch(" ton api  =>  /signUp", {
                method: "POST",
                headers: {
                'Content-type': 'application/json',
            },
            body: JSON.stringify({"email": email,"password":password}),

            });

            if(!response.ok){
                console.error("Error ")

            }
            const data = await response.json();
            console.info("user created : ", data)
            navigate("/Dashboard");
         


        }catch(error){
            console.log("Error during registration ", error)
        }
        
    }

    
    return(
        <div className="signup-container">

            <form onSubmit={registration}>
                <label>Prénom </label>
                <input type="text" value={name} onChange={(e)=>{setName(e.target.value)}} />
                <label>Nom</label>
                <input type="text" value={lastName} onChange={(e)=> {setLastName(e.target.value)}} />
                <label>Email</label>
                <input type="email" value={email} onChange={(e)=>{setEmail(e.target.value)}} />
                <label>Password</label>
                <input type="password" value={password} onChange={(e)=>{setPassword(e.target.value)}} />
                <button type="Submit"> s'inscrire</button>
            </form>
            <p>déja inscrit ? <a href="/Login">Connexion</a></p>
        </div>
    )
}

export default SignUp;

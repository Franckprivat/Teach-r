
import { useState } from "react";
import { useNavigate } from "react-router";


const Login = () =>{
    const navigate = useNavigate();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
        

    const connexion = async (e) => {
        e.preventDefault();
        
        try {
            const response = await fetch("Met  ta route ici avec /Login a la fin", {
                method: "POST",
                headers: {
                    'Content-type': 'application/json',
                },
                body: JSON.stringify({ "email":email, "password":password }),
            });
            if (!response.ok) {
                console.error("That's not working ");
            }
            const data = await response.json();
            console.info("user connecred", data);
            navigate("Dashboard");
        } catch (error) {
            console.error("error during connexion ", error);
        }
    };

    return(
        <div>
            <div className="login-container">
            <div className="Wrapper-Login">
                <h1>Connexion</h1>
                <form onSubmit={connexion}>
                    <label>Email :</label>
                    <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
                    <label>Password :</label>
                    <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
                    <button type="submit">Se connecter</button>
                </form>
                <p>
                    Pas de compte ? Inscrivez-vous <a href="/SignUp">ici</a>
                </p>
            </div>
        </div>
        </div>
    )
}

export default Login;
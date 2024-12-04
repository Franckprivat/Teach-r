import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";

const SignUp = () => {
    const [firstName, setFirstName] = useState("");
    const [lastName, setLastName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const navigate = useNavigate();

    const registration = async (e) => {
        e.preventDefault();
        try {
            const response = await fetch("http://127.0.0.1:8000/api/signup", {
                method: "POST",
                headers: {
                    "Content-type": "application/json",
                },
                body: JSON.stringify({ firstName, lastName, email, password }),
            });

            if (!response.ok) {
                console.error("Erreur d'inscription");
                return;
            }

            const data = await response.json();
            console.info("Utilisateur créé : ", data);
            navigate("/Shop");
        } catch (error) {
            console.error("Erreur pendant l'inscription :", error);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50 px-4">
            <div className="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
                <h1 className="text-3xl font-bold text-[#0056b3] mb-6 text-center">
                    Inscription
                </h1>
                <form onSubmit={registration} className="space-y-6">
                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Prénom
                        </label>
                        <input
                            type="text"
                            placeholder="Votre prénom"
                            value={firstName}
                            onChange={(e) => setFirstName(e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Nom
                        </label>
                        <input
                            type="text"
                            placeholder="Votre nom"
                            value={lastName}
                            onChange={(e) => setLastName(e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input
                            type="email"
                            placeholder="exemple@exemple.com"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Mot de passe
                        </label>
                        <input
                            type="password"
                            placeholder="********"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            className="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            required
                        />
                    </div>
                    <input
                        type="submit"
                        value="S'inscrire"
                        className="w-full py-3 bg-[#0056b3] text-white rounded-full font-semibold text-center hover:bg-blue-700 transition cursor-pointer"
                    />
                </form>
                <p className="mt-4 text-center text-sm text-gray-600">
                    Déjà inscrit ?
                    <Link
                        to="/Login"
                        className="text-[#0056b3] hover:underline font-medium"
                    >
                        Connexion
                    </Link>
                </p>
            </div>
        </div>
    );
};

export default SignUp;
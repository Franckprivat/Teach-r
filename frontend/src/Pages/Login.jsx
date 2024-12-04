import { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useNavigate } from "react-router";
import { Link } from "react-router-dom";
import loginImg from "../Assets/login-img.png";
 
const Login = () => {
    const navigate = useNavigate();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
 
    const connexion = async (e) => {
        e.preventDefault();
 
        try {
            const response = await fetch("http://127.0.0.1:8000/api/login", {
                method: "POST",
                headers: {
                    "Content-type": "application/json",
                },
                body: JSON.stringify({ email, password }),
            });
            if (!response.ok) {
                console.error("That's not working");
            }
            const data = await response.json();
            console.info("user connected", data);
            navigate("/Shop");
        } catch (error) {
            console.error("error during connexion ", error);
        }
    };
 
    return (
        <div className="min-h-screen flex items-center justify-between bg-white px-6 lg:px-20">
            <div className="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
                <h1 className="text-3xl font-bold text-[#0056b3] mb-6 text-center">
                    Connexion
                </h1>
                <form onSubmit={connexion} className="space-y-6">
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
                        <div className="relative">
                            <input
                                type="password"
                                placeholder="********"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                required
                            />
                            <button
                                type="button"
                                className="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600"
                            >
                                <FontAwesomeIcon icon="eye" />
                            </button>
                        </div>
                    </div>
                    <div className="flex items-center justify-between">
                        <label className="flex items-center text-sm text-gray-600">
                            <input type="checkbox" className="mr-2" />
                            Se souvenir de moi
                        </label>
                        <a
                            href="/forgot-password"
                            className="text-sm text-[#0056b3] hover:underline"
                        >
                            Mot de passe oublié ?
                        </a>
                    </div>
                    <div className="flex justify-between space-x-4">
                        <Link
                            to="/SignUp"
                            className="flex-1 py-3 border border-blue-600 text-blue-600 rounded-full font-semibold text-center hover:bg-blue-50 transition"
                        >
                            JE M'INSCRIS
                        </Link>
                        <input
                            type="submit"
                            value="CONNEXION"
                            className="flex-1 py-3 bg-[#0056b3] text-white rounded-full font-semibold text-center hover:bg-blue-700 transition cursor-pointer"
                        />
                    </div>
                </form>
                <div className="my-6 border-t border-gray-300" />
                <p className="text-center text-sm text-gray-600 mb-4">
                    Ou se connecter avec :
                </p>
                <div className="flex justify-center space-x-4">
                    <button className="p-3 bg-gray-100 rounded-full shadow hover:bg-gray-200">
                        <FontAwesomeIcon icon={["fab", "google"]} className="text-red-500 text-xl" />
                    </button>
                    <button className="p-3 bg-gray-100 rounded-full shadow hover:bg-gray-200">
                        <FontAwesomeIcon icon={["fab", "apple"]} className="text-black text-xl" />
                    </button>
                    <button className="p-3 bg-gray-100 rounded-full shadow hover:bg-gray-200">
                        <FontAwesomeIcon icon={["fab", "facebook"]} className="text-blue-600 text-xl" />
                    </button>
                    <button className="p-3 bg-gray-100 rounded-full shadow hover:bg-gray-200">
                        <FontAwesomeIcon icon="sms" className="text-green-600 text-xl" />
                    </button>
                </div>
            </div>
            <div className="hidden lg:block w-1/2 bg-white">
                <img
                    src={loginImg}
                    alt="Login Illustration"
                    className="w-full"
                />
            </div>
        </div>
    );
};

export default Login;
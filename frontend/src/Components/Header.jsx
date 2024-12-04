import React from "react";
import { Link } from "react-router-dom";
import logo from "../Assets/logo-white.png";

const navigation = [
  { name: "Accueil", href: "/Home" },
  { name: "Demander un livre", href: "/Shop" },
  { name: "Vendre un livre", href: "/SellBook" },
];

export default function Navbar() {
  return (
    <header className="bg-blue-500 p-6">
      <nav className="flex items-center justify-between">
        <div>
          <Link to="/">
            <img src={logo} alt="Teach'R logo" className="h-12 w-auto" />
          </Link>
        </div>

        <div className="flex gap-x-8">
          {navigation.map((item) => (
            <Link
              key={item.name}
              to={item.href}
              className="text-white text-sm font-semibold"
            >
              {item.name}
            </Link>
          ))}
        </div>

   
        <div>
          <Link
            to="/Login"
            className="text-white text-sm font-semibold"
          >
            Se connecter <span aria-hidden="true">&rarr;</span>
          </Link>
        </div>
      </nav>
    </header>
  );
}

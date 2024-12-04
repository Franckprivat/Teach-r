import Header from "../Components/Header.jsx";
import Footer from "../Components/Footer.jsx";
import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";

const Shop = () => {
  const [book, setBook] = useState([]);

  useEffect(() => {
    const fetchBook = async () => {
      try {
        const response = await fetch("http://127.0.0.1:8000/", {
          method: "GET",
          headers: {
            "Content-type": "application/json",
          },
        });

        if (!response.ok) {
          console.error("Erreur lors de la récupération des livres :", response.status);
          return;
        }

        const data = await response.json();
        setBook(data);
        console.info("Données des livres récupérées :", data);
      } catch (error) {
        console.error("Erreur réseau ou autre :", error);
      }
    };

    fetchBook();
  }, []);

  return (
    <div className="flex flex-col min-h-screen">
      <Header />
      <main className="flex-grow flex items-center justify-center bg-gray-100">
        <div className="p-10 bg-white rounded-lg text-center shadow-lg max-w-3xl w-full">
          <p className="font-montserrat text-gray-700 text-lg font-normal mb-4">
            Bienvenue sur Teach'R !
          </p>
          <h1 className="font-montserrat text-gray-900 text-2xl font-semibold mb-6">
            Découvrez nos {book.length} livres et trouvez celui qui fera votre bonheur !
          </h1>
          <Link
            to="/Shop"
            className="font-montserrat text-base font-medium text-gray-700 bg-yellow-400 px-6 py-3 rounded-md hover:bg-yellow-500 hover:-translate-y-1 transition-transform"
          >
            Voir plus !
          </Link>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default Shop;

import { useState } from "react";
import api from "../services/api";
import { useNavigate } from "react-router-dom";
import "../assets/css/login.css";

export default function Login() {
  const [loading, setLoading] = useState(false);
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [erro, setErro] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    setErro("");
    setLoading(true);

    try {
      const res = await api.post("/login", {
        email,
        password
      });

      localStorage.setItem("token", res.data.access_token);
      localStorage.setItem("user", JSON.stringify(res.data.user));
      localStorage.setItem("menus", JSON.stringify(res.data.menus));

      const perfil = res.data.user.perfil?.tipo_perfil;

      if (perfil === "ADMG" || perfil === "ADM") {
        navigate("/dashboard");
      } else {
        navigate("/entradas");
      }

    } catch (err) {
      setErro("Email ou senha inválidos");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="login-wrapper">

      {/* Lado institucional */}
      <div className="login-left">
        <div className="login-left-content">
          <h1>Controle de Entradas PEV</h1>
          <p>
            Sistema para gestão dos Pontos de Entrega de Pequenos Volumes.
            Registro de resíduos, imagens e geração de indicadores para apoio
            à tomada de decisão.
          </p>
        </div>
      </div>

      {/* Card de login */}
      <div className="login-right">
        <div className="login-card">
          <h2>Acessar sistema</h2>

          <form onSubmit={handleLogin}>
            <div className="input-group">
              <label>Email</label>
              <input
                type="email"
                placeholder="usuario@exemplo.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>

            <div className="input-group">
              <label>Senha</label>
              <input
                type="password"
                placeholder="••••••••"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>

            {erro && <div className="erro">{erro}</div>}

            <button type="submit" disabled={loading}>
              {loading ? (
                <>
                  <span className="spinner"></span>
                  Entrando...
                </>
              ) : (
                "Entrar"
              )}
            </button>
          </form>

          <div className="login-footer">
            <small>Sistema SLU • PEV</small>
          </div>
        </div>
      </div>
    </div>
  );
}

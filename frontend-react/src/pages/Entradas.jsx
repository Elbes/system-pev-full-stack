import { useEffect, useState } from "react";
import Layout from "../components/Layout/Layout";
import api from "../services/api";
import "../assets/css/entradas.css";

export default function Entradas() {
  const [tipos, setTipos] = useState([]);
  const [ras, setRas] = useState([]);
  const [irregularidades, setIrregularidades] = useState([]);
  const [ultimas, setUltimas] = useState([]);

  const [foto, setFoto] = useState(null);
  const [preview, setPreview] = useState(null);
  const [mostrarIrregular, setMostrarIrregular] = useState(false);

  const [form, setForm] = useState({
    placa: "",
    id_ra: "",
    residuos: [],
    irregularidade: false,
    id_irregularidade: ""
  });

  useEffect(() => {
    carregarDados();
  }, []);

  const carregarDados = async () => {
    const res = await api.get("/entradas/dados");
    setTipos(res.data.tipos_residuo);
    setRas(res.data.ras);
    setIrregularidades(res.data.irregularidades);
    setUltimas(res.data.ultimas);
  };

  // ===== FOTO =====
  const handleFoto = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    setFoto(file);
    setPreview(URL.createObjectURL(file));
  };

  // ===== RESÍDUOS =====
  const toggleResiduo = (id) => {
    let lista = [...form.residuos];

    if (lista.includes(id)) {
      lista = lista.filter(r => r !== id);
    } else {
      lista.push(id);
    }

    setForm({ ...form, residuos: lista });
  };

  // ===== IRREGULARIDADE =====
  const handleIrregularidade = (e) => {
    const checked = e.target.checked;
    setForm({ ...form, irregularidade: checked });
    setMostrarIrregular(checked);
  };

  // ===== SUBMIT =====
  const handleSubmit = async (e) => {
    e.preventDefault();

    const data = new FormData();
    data.append("placa", form.placa);
    data.append("id_ra", form.id_ra);
    data.append("irregularidade", form.irregularidade);
    data.append("id_irregularidade", form.id_irregularidade);

    form.residuos.forEach(r => data.append("residuos[]", r));

    if (foto) {
      data.append("foto", foto);
    }

    await api.post("/entradas", data, {
      headers: { "Content-Type": "multipart/form-data" }
    });

    alert("Entrada registrada!");
    carregarDados();
  };

  return (
    <Layout>
      <h2 className="page-title">Entradas</h2>

      <form onSubmit={handleSubmit}>
        <div className="card">
          <div className="card-header">Dados da Entrada</div>
          <div className="card-body">

            {/* TIPOS */}
            <label>Tipo de Resíduo</label>
            <div className="checkbox-group">
              {tipos.map(t => (
                <label key={t.id_residuo}>
                  <input
                    type="checkbox"
                    onChange={() => toggleResiduo(t.id_residuo)}
                  />
                  {t.nome_residuo}
                </label>
              ))}
            </div>

            <div className="form-row">
              <div>
                <label>Placa</label>
                <input
                  value={form.placa}
                  onChange={e => setForm({ ...form, placa: e.target.value })}
                  placeholder="Digite a placa"
                />
              </div>

              <div>
                <label>RA Origem</label>
                <select
                  value={form.id_ra}
                  onChange={e => setForm({ ...form, id_ra: e.target.value })}
                >
                  <option value="">Selecione</option>
                  {ras.map(ra => (
                    <option key={ra.id_ra} value={ra.id_ra}>
                      {ra.nome_ra}
                    </option>
                  ))}
                </select>
              </div>

              <div className="switch">
                <label>
                  <input
                    type="checkbox"
                    onChange={handleIrregularidade}
                  />
                  Irregularidade
                </label>
              </div>
            </div>

            {/* LISTA DE IRREGULARIDADES */}
            {mostrarIrregular && (
              <div className="form-group">
                <label>Tipo de Irregularidade</label>
                <select
                  value={form.id_irregularidade}
                  onChange={e =>
                    setForm({ ...form, id_irregularidade: e.target.value })
                  }
                >
                  <option value="">Selecione</option>
                  {irregularidades.map(i => (
                    <option key={i.id_irregularidade} value={i.id_irregularidade}>
                      {i.nome_irregularidade}
                    </option>
                  ))}
                </select>
              </div>
            )}

            {/* FOTO */}
            <div className="foto-area">
              <label className="btn-secondary">
                Tirar Foto
                <input
                  type="file"
                  accept="image/*"
                  capture="environment"
                  onChange={handleFoto}
                  hidden
                />
              </label>

              {preview && (
                <div className="preview">
                  <img src={preview} alt="preview" />
                </div>
              )}
            </div>

            <button className="btn-primary full">
              Registrar
            </button>

          </div>
        </div>
      </form>

      {/* Últimas */}
      <div className="card">
        <div className="card-header">Últimas Entradas</div>
        <div className="card-body">
          <table className="table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Hora</th>
              </tr>
            </thead>
            <tbody>
              {ultimas.map(e => (
                <tr key={e.id_entrada}>
                  <td>{e.dhs_cadastro?.substring(0,10)}</td>
                  <td>{e.dhs_cadastro?.substring(11,16)}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </Layout>
  );
}
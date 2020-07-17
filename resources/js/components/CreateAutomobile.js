import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import '../../../public/js/yearpicker'
import '../../../public/css/yearpicker.css';
import YearPicker from "react-year-picker";

class CreateAutomobile extends Component {

    constructor() {
        super();
        this.state = {
            marques: [],
            modelesMarque: [],
            nom_marque: '',
            modele: '',
            couleur: '',
            sortie: '',
            priorite: '',
            prix: 0,
            photo: null,
            error: '',
            success: '',
            isLoading: false
        }

        this.getModelesMarque = this.getModelesMarque.bind(this);
        this.onHandleChange = this.onHandleChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.sendData = this.sendData.bind(this);

    }

    componentDidMount () {
        $('.yearpicker').yearpicker();
        axios.get(`/getMarques`)
        .then(res => {
            const { data } = res;
            if (data.status === 'success') {
                const { marques } = data;
                this.setState({ marques })
            }
        })
    }

    getModelesMarque(marque_id) {
      axios.get(`/getModelesMarque/${marque_id}`)
      .then(
        response => {
          const { data } = response;
          if (data.status === 'success') {
            let {modelesMarque} = data;
            this.setState({ modelesMarque });
            console.log('modelesMarque', modelesMarque);
          }
        }
      )
    }

    onHandleChange (e){
        const{ name, value } = e.target;
        this.setState({error: ''});

        switch (name) {
            case 'nom_marque':
              this.setState({ nom_marque: value });
              this.getModelesMarque(value);
              break;

            case 'modele':
              this.setState({ modele: value});
              break;

            case 'couleur':
              this.setState({ couleur: value});
              break;

            case 'sortie':
              this.setState({ sortie: value});
              break;

            case 'priorite':
              this.setState({ priorite: value});
              break;

            case 'prix':
              this.setState({ prix: value});
              break;

            case 'photo':
              this.setState({ photo: e.target.files[0] });
              console.log('photo', photo);
              break;

            default:
                break;
        }
    }

    onSubmit (e) {
      e.preventDefault();
      const { nom_marque, modele, couleur, sortie, priorite, prix, photo } = this.state;
      let { error } = this.state;
      this.setState({isLoading: true});

      if (nom_marque === "") {
        error = "Veuillez sélectionner une marque";
      }else if (modele === "") {
        error = "Veuillez sélectionner un modèl";
      }else if (couleur === "") {
        error = "Veuillez sélectionner une couleur";
      }else if (sortie === "") {
        error = "Veuillez sélectionner une année de sortie";
      }else if (priorite === "") {
        error = "Veuillez sélectionner la priorité de la voiture";
      }else if (prix === "" || prix <= 0) {
        error = "Veuillez saisir le montant";
      }else if (photo === "") {
        error = "Veuillez choisir une image";
      }

      if (error === '') {
        this.sendData();
      } else {
        this.setState({ error, isLoading: false });
      }
    }

    sendData () {
      let formData = new FormData();
      formData.append('nom_marque', this.state.nom_marque);
      formData.append('modele', this.state.modele);
      formData.append('couleur', this.state.couleur);
      formData.append('sortie', this.state.sortie);
      formData.append('priorite', this.state.priorite);
      formData.append('prix', this.state.prix);
      formData.append('photo', this.state.photo );

      axios.post(`/automobile/store`, formData)
      .then(
        response => {
            const { data } = response;
            let { success, error } = this.state;
            if (data.status === 'success') {
                success = data.message;
                this.setState({ success });
                const { nom_marque, modele, couleur, sortie, priorite, prix, photo } = this.state;
                this.setState({ nom_marque: '', modele: '', couleur: '', sortie: '', prix: 0, photo: null, priorite: '' });
                setTimeout(() => {
                    this.setState({ success: ''});
            }, 3000);
          }else{
            console.log('errors', data.errors);

            if (data.errors['nom_marque'] !== undefined) {
              error = data.errors['nom_marque'][0];
            }
            else if (data.errors['modele'] !== undefined) {
              error = data.errors['modele'][0];
            }
            else if (data.errors['couleur'] !== undefined) {
              error = data.errors['couleur'][0];
            }
            else if (data.errors['sortie'] !== undefined) {
              error = data.errors['sortie'][0];
            }
            else if (data.errors['priorite'] !== undefined) {
              error = data.errors['priorite'][0];
            }
            else if (data.errors['prix'] !== undefined) {
              error = data.errors['prix'][0];
            }
            else if (data.errors['photo'] !== undefined) {
              error = data.errors['photo'][0];
            }
            else if (data.errors['date_sortie' !== undefined]) {
                error = data.errors['date_sortie'][0];
            }
            else if (data.errors['prix_null' !== undefined]) {
                error = data.errors['prix_null'][0];
            }
            else if( data.errors !== ""){
              error = data.errors;
            }
            //error = data.errors;
            this.setState({ error });
          }
          this.setState({ isLoading: false });
        }
      )
    }

    render() {
        const { marques, modelesMarque, error, isLoading, success } = this.state;
        return (
            <div className="row">
                <div className="col-md-2"></div>
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">
                            <h4 className="card-title"> Ajouter Automobile</h4>
                        </div>
                        <div className="card-body">
                            <form onSubmit= { this.onSubmit } enctype="multipart/form-data">
                                {
                                  error !== "" ? <div className="col-12 text-danger mb-2 mt-2 text-center">{ error }</div> : ""
                                }
                                {
                                  success !== "" ? <div className="col-12 text-success mb-2 mt-2 text-center">{ success }</div> : ""
                                }

                                    <div className="column">
                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Marque</label>
                                                    <select
                                                        name="nom_marque" value={this.state.nom_marque}
                                                        onChange={this.onHandleChange} className="form-control">
                                                        <option>Veuillez sélectionner une marque</option>
                                                        {
                                                            marques.map((marque, i) =>
                                                                <option key={i} value={marque.id}> { marque.nom_marque }</option>
                                                            )
                                                        }
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Modèl</label>
                                                    <select value={this.state.modele} name="modele"
                                                    onChange={this.onHandleChange} className="form-control">
                                                        <option value="">Veuillez sélectionner un modèl</option>
                                                        {
                                                            modelesMarque.length > 0 ?
                                                            modelesMarque.map((item, i) =>
                                                                <option key={i} value={item.modele_id}> {item.version}</option>
                                                            ) :
                                                            <option value="">Cette marque n'a pas encore de modèl</option>
                                                        }

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Couleur</label>
                                                    <select onChange={this.onHandleChange} value={this.state.couleur} name="couleur" className="form-control" >
                                                        <option value="">Veuillez sélectionner une couleur</option>
                                                        <option value="bleu">Bleu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Annee de sortie</label>

                                                    {/* <YearPicker onChange={this.onHandleChange} className="form-control" name="sortie" value={this.state.sortie}  />
 */}
                                                    <input onChange={this.onHandleChange} type="text" className="form-control yearpicker" name="sortie" value={this.state.sortie} />
                                                 </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                <label for="">Priorité</label>
                                                <select onChange={this.onHandleChange} className="form-control" name="priorite" value={this.state.priorite} >
                                                    <option>Sélectionnez la priorité d'affichage</option>
                                                    <option value="1">Dans accueil</option>
                                                    <option value="0">Dans Achat</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Prix CFA</label>
                                                    <input onChange={this.onHandleChange} type="text" className="form-control" name="prix" value={this.state.prix} placeholder="Prix CFA" />

                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8 pr-1">
                                                <div className="form-group">
                                                    <label>Photo</label>
                                                    <input onChange={this.onHandleChange} type="file" className="form-control-file" name="photo" aria-describedby="fileHelpId" />

                                                </div>
                                            </div>
                                        </div>

                                        <div className="row">
                                            <div className="col-md-2"></div>
                                            {
                                                isLoading ? <button disabled className="col-md-8 pr-1 btn btn-info btn-fill pull-right">En Cours ...</button>
                                                : <button type="submit" className="col-md-8 pr-1 btn btn-info btn-fill pull-right">Enregistrer</button>
                                            }
                                        </div>
                                    </div>

                                    <div className="clearfix"></div>
                                </form>
                        </div>
                    </div>
                </div>

            </div>
        );
    }
}

export default CreateAutomobile;
if (document.getElementById('addAutomobile')) {
    ReactDOM.render(<CreateAutomobile />, document.getElementById('addAutomobile'));
}

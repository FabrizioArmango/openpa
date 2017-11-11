import React, { Component } from 'react';
import CurrentLocation from './CurrentLocation';
import LocationList from './LocationList';
import { GMaps } from 'react-gmaps';
import Search from './Search';
import Map from './Map';
import { Link } from 'react-router-dom';
import './Home.css'

class Home extends Component {

	constructor(props) {
		super(props);

		this.state = {
			mapCoordinates: {
				lat: 38.1156879,
				lng: 13.3612671
			}
		}

	}

	searchForAddress(address) {

		var self = this;
		// implement location search
	}

	render() {
		return (
			<ul className="list">
				{
					/*
				<li className="item">
					<Link id="home"  to="/"><FaHome/> Home</Link>
				</li>
					*/
				}

				<Link id="foodlist" to="/foodlist">
					<li className="item">
						<h3 className="headline">Cibi Tipici</h3>
					</li>
				</Link>

				<Link id="churchlist" to="/churchlist">
					<li className="item">
						<h3 className="headline">Chiese</h3>
					</li>
				</Link>

				<Link id="theatrelist" to="/theatrelist">
					<li className="item">
						<h3 className="headline">Teatri</h3>
					</li>
				</Link>

				<Link id="cinemalist" to="/cinemalist">
					<li className="item">
						<h3 className="headline">Cinema</h3>
					</li>
				</Link>

				<Link id="publist" to="/publist">
					<li className="item">
						<h3 className="headline">Pubs</h3>
					</li>
				</Link>

				<Link id="cocktailbarslist" to="/cocktailbarlist">
					<li className="item">
						<h3 className="headline">Cocktail Bars</h3>
					</li>
				</Link>

				<Link id="winebarlist" to="/winebarlist">
					<li className="item">
						<h3 className="headline">Wine Bars</h3>
					</li>
				</Link>

				<Link id="streetfoodlist" to="/streetfoodlist">
					<li className="item">
						<h3 className="headline">Street Foods</h3>
					</li>
				</Link>

				<Link id="restaurantlist" to="/restaurantlist">
					<li className="item">
						<h3 className="headline">Ristoranti</h3>
					</li>
				</Link>

				<Link id="discolist" to="/discolist">
					<li className="item">
						<h3 className="headline">Discoteche</h3>
					</li>
				</Link>
			</ul>
		);
	}

}

export default Home;
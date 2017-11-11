import React, { Component } from 'react';

import './App.css';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import {
  BrowserRouter,
  Route,
  Link
} from 'react-router-dom';


import Home from './Home';
import FoodList from './FoodList';
//import MenuBar from './MenuBar';
import FoodView from './FoodView';
import ChurchList from './ChurchList';
import ChurchView from './ChurchView';
import TheatreList from './TheatreList';
import CinemaList from './CinemaList';
import CinemaView from './CinemaView';
import PubList from './PubList';
import CocktailbarList from './CocktailbarList';
import WinebarList from './WinebarList';
import StreetfoodList from './StreetfoodList';
import RestaurantList from './RestaurantList';
import DiscoList from './DiscoList';
import Cache from './Cache';
import FaHome from 'react-icons/lib/fa/home';

class App extends Component {

  constructor(props)
  {
    super(props);

    this.cache = new Cache();  
  }

  render() {
    return (
      <MuiThemeProvider>
          <BrowserRouter>
              <div className="App">
                
                  <div className="App-header">                                    
                    <Link id="home" className="menu-item" to="/"><h2> <FaHome/> APPalermo</h2></Link>                
                  </div>
                  <div className="App-body">
                      <Route exact path="/" component={Home}/>
                      <Route path="/foodlist" component={FoodList}/>                        
                        {/*<Route path="/foodview" component={FoodView}/>*/}
                      <Route path="/churchlist" component={ChurchList}/>
                        <Route path="/churchview" component={ChurchView}/>
                      <Route path="/theatrelist" component={TheatreList}/>
                      
                      <Route path="/cinemalist" component={CinemaList}/>
                        <Route path="/cinemaview" component={CinemaView}/>
                      <Route path="/publist" component={PubList}/>
                      <Route path="/cocktailbarlist" component={CocktailbarList}/>
                      <Route path="/winebarlist" component={WinebarList}/>
                      <Route path="/streetfoodlist" component={StreetfoodList}/>
                      <Route path="/restaurantlist" component={RestaurantList}/>
                      <Route path="/discolist" component={DiscoList}/>
                                          
                  </div> 
              </div>
          </BrowserRouter>
        </MuiThemeProvider>
      ); 
  }


}

export default App;

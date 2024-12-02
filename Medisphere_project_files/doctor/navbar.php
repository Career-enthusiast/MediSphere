<!-- navbar.php -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN FORM</title>
    <link rel="stylesheet" href="style_nav.css">
</head>

<body>
    <div>
        <nav class="navbar">
            <hr>
            <hr>
            <div class="navbar-content">
                <div class="logo">
                    <img src="logo.png" alt="Logo" width="60px" height="60px" style="vertical-align: middle;">
                    <h1 style="display: inline; vertical-align: middle; color: aliceblue;">Medi Sphere</h1>
                </div>
            </div>
            <hr>
            <ul>
                <li><a href="home.php"><span class="icon"><ion-icon name="home"></ion-icon></span>HOME</a></li>
                <li class="dropdown">
                <a href="Health_Condition.html" class="dropbtn"><span class="icon">
                            <ion-icon name="medkit"></ion-icon>
                        </span>Health Condition</a>
                    <div class="dropdown-content">
                        <div class="sub-dropdown">
                         <a href="medicines.php?condition=Infections">Infections</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Infections&symptom=Fever">Fever</a>
                                <a href="medicines.php?condition=Infections&symptom=Cough">Cough</a>
                                <a href="medicines.php?condition=Infections&symptom=Sore throat">Sore throat</a>
                                <a href="medicines.php?condition=Infections&symptom=Body aches">Body aches</a>
                                <a href="medicines.php?condition=Infections&symptom=Nausea">Nausea</a>
                                <a href="medicines.php?condition=Infections&symptom=Diarrhea">Diarrhea</a>
                                <a href="medicines.php?condition=Infections&symptom=Skin rash">Skin rash</a>
                                <a href="medicines.php?condition=Infections&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Infections&symptom=Chills">Chills</a>
                                <a href="medicines.php?condition=Infections&symptom=Headache">Headache</a>
                            </div>
                        </div>
                        
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Blood Pressure">Blood Pressure</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Blood Pressure&symptom=Headache">Headache</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Dizziness">Dizziness</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Chest pain">Chest pain</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Shortness of breath">Shortness of breath</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Palpitations">Palpitations</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Vision changes">Vision changes</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Nausea">Nausea</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Sweating">Sweating</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Tinnitus">Tinnitus</a>
                                <a href="medicines.php?condition=Blood Pressure&symptom=Sleep disturbances">Sleep disturbances</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Asthma">Asthma</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Asthma&symptom=Shortness of breath">Shortness of breath</a>
                                <a href="medicines.php?condition=Asthma&symptom=Coughing">Coughing</a>
                                <a href="medicines.php?condition=Asthma&symptom=Wheezing">Wheezing</a>
                                <a href="medicines.php?condition=Asthma&symptom=Chest tightness">Chest tightness</a>
                                <a href="medicines.php?condition=Asthma&symptom=Difficulty breathing">Difficulty breathing</a>
                                <a href="medicines.php?condition=Asthma&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Asthma&symptom=Anxiety">Anxiety</a>
                                <a href="medicines.php?condition=Asthma&symptom=Sleep disturbances">Sleep disturbances</a>
                                <a href="medicines.php?condition=Asthma&symptom=Nasal Congestion">Nasal Congestion</a>
                                <a href="medicines.php?condition=Asthma&symptom=Feeling tired">Feeling tired</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Diabetes">Diabetes</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Diabetes&symptom=Increased thirst">Increased thirst</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Frequent urination">Frequent urination</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Blurred vision">Blurred vision</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Slow healing sores">Slow healing sores</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Tingling in hands/feet">Tingling in hands/feet</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Increased hunger">Increased hunger</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Skin infections">Skin infections</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Mood changes">Mood changes</a>
                                <a href="medicines.php?condition=Diabetes&symptom=Nausea">Nausea</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Ulcers">Ulcers</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Ulcers&symptom=Abdominal pain">Abdominal pain</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Bloating">Bloating</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Nausea">Nausea</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Heartburn">Heartburn</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Loss of appetite">Loss of appetite</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Weight loss">Weight loss</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Indigestion">Indigestion</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Changes in stool">Changes in stool</a>
                                <a href="medicines.php?condition=Ulcers&symptom=Mouth sores">Mouth sores</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Heart Medicines">Heart Medicines</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Heart Medicines&symptom=Chest pain">Chest pain</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Shortness of breath">Shortness of breath</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Palpitations">Palpitations</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Swelling in legs">Swelling in legs</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=High blood pressure">High blood pressure</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Anxiety">Anxiety</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Cold sweats">Cold sweats</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Heart rhythm issues">Heart rhythm issues</a>
                                <a href="medicines.php?condition=Heart Medicines&symptom=Fatigue after surgery">Fatigue after surgery</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Obesity">Obesity</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Obesity&symptom=Weight gain">Weight gain</a>
                                <a href="medicines.php?condition=Obesity&symptom=Increased appetite">Increased appetite</a>
                                <a href="medicines.php?condition=Obesity&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Obesity&symptom=Joint pain">Joint pain</a>
                                <a href="medicines.php?condition=Obesity&symptom=Breathing difficulties">Breathing difficulties</a>
                                <a href="medicines.php?condition=Obesity&symptom=High blood pressure">High blood pressure</a>
                                <a href="medicines.php?condition=Obesity&symptom=Sleep apnea">Sleep apnea</a>
                                <a href="medicines.php?condition=Obesity&symptom=Insulin resistance">Insulin resistance</a>
                                <a href="medicines.php?condition=Obesity&symptom=Skin problems">Skin problems</a>
                                <a href="medicines.php?condition=Obesity&symptom=Emotional distress">Emotional distress</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Depression">Depression</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Depression&symptom=Persistent sadness">Persistent sadness</a>
                                <a href="medicines.php?condition=Depression&symptom=Loss of interest">Loss of interest</a>
                                <a href="medicines.php?condition=Depression&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Depression&symptom=Changes in appetite">Changes in appetite</a>
                                <a href="medicines.php?condition=Depression&symptom=Difficulty concentrating">Difficulty concentrating</a>
                                <a href="medicines.php?condition=Depression&symptom=Sleep disturbances">Sleep disturbances</a>
                                <a href="medicines.php?condition=Depression&symptom=Feelings of hopelessness">Feelings of hopelessness</a>
                                <a href="medicines.php?condition=Depression&symptom=Irritability">Irritability</a>
                                <a href="medicines.php?condition=Depression&symptom=Social withdrawal">Social withdrawal</a>
                                <a href="medicines.php?condition=Depression&symptom=Suicidal thoughts">Suicidal thoughts</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Cholesterol Disorders">Cholesterol Disorders</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=High LDL cholesterol">High LDL cholesterol</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=High total cholesterol">High total cholesterol</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=High triglycerides">High triglycerides</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Chest pain (angina)">Chest pain (angina)</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Fatigue">Fatigue</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Nausea">Nausea</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Shortness of breath">Shortness of breath</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=High blood pressure">High blood pressure</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Yellowing of skin (jaundice)">Yellowing of skin (jaundice)</a>
                                <a href="medicines.php?condition=Cholesterol Disorders&symptom=Family history of heart disease">Family history of heart disease</a>
                            </div>
                        </div>
                        <div class="sub-dropdown">
                        <a href="medicines.php?condition=Insomnia">Insomnia</a>
                            <div class="sub-dropdown-content">
                                <a href="medicines.php?condition=Insomnia&symptom=Difficulty falling asleep">Difficulty falling asleep</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Waking up frequently">Waking up frequently</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Early morning awakening">Early morning awakening</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Poor sleep quality">Poor sleep quality</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Daytime fatigue">Daytime fatigue</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Anxiety about sleep">Anxiety about sleep</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Stress-induced insomnia">Stress-induced insomnia</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Restlessness">Restlessness</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Irritability due to lack of sleep">Irritability due to lack of sleep</a>
                                <a href="medicines.php?condition=Insomnia&symptom=Sleep disruptions from noise">Sleep disruptions from noise</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="nutritional_supplements.php" class="dropbtn"><span class="icon">
                            <ion-icon name="nutrition"></ion-icon>
                        </span>Nutrition Supplements</a>
                    <!-- <div class="dropdown-content">
                        <a>Ayurvedics</a>
                        <a>Herbal</a>
                    </div> -->

                </li>
                <li class="dropdown">
                    <a href="Health_Corner.html" class="dropbtn"><span class="icon">
                            <ion-icon name="heart"></ion-icon>
                        </span>Health Corner</a>
                    <div class="dropdown-content">
                        <a>Ayurvedics</a>
                        <a>Herbal</a>
                    </div>
                </li>
                <li><a href="cart.php"><span class="icon">
                            <ion-icon name="cart"></ion-icon>
                        </span>Cart</a></li>
                <li class="dropdown">
                    <a href="profile.php" class="dropbtn"><span class="icon">
                            <ion-icon name="people"></ion-icon>
                        </span>Profile</a>
                   
                    <div class=logout>
                    <li><a href="logout.php" class="logout-button">Logout</a></li>

                            </li>
                       </div> 
                       <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

            </ul>
        </nav>
        
  
    </div>
</body>

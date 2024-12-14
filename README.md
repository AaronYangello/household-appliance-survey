# Hemkraft Demo

- Start at MainMenu.php

## Reports

From the Main Menu
- Click "View Reports" -> Navigate to generate_reports.php

### Top 25 Manufacturers Report
From Generate Hemkraft Reports Page    
- Click Top 25 Manufacturer Report -> Navigate to top_manufacturers.php
    - Click "Bareredgantor Holdings Group" -> Navigate to manufacturer_drilldown_report.php?manufacturer=Bareredgantor+Holdings+Group
        - Click return to manufacturer report -> Navigate vack to top_manufacturers.php
    - Click Reports -> Navigate to generate_reports.php

### Average TV Display Size by State Report
From Generate Hemkraft Reports Page 
- Click Average TV Display Size by State Report -> Navigate to average_display_tv_states_report.php
    - Click GA Drill Down -> Nav to tv_drilldown_report.php?state=GA
        - Click return average display tv states report
    - Click Reports -> Navigate to generate_reports.php

### Laundry Center Report 
From Generate Hemkraft Reports Page 
- Click Laundry Center Report -> Navigate to laundry_report.php
- Click Reports -> Navigate to generate_reports.php

### Household Averages by Search Radius
From Generate Hemkraft Reports Page
- Click Household Averages by Radius Report button -> Navigate to search_radius_averages.php
    - Enter whitespace or an invalid postal code (like "123")
        - Verify that error appears
    - Enter Postal Code: "00501" (valid postal code) and select 0 miles
        - Verify that table appears
    - Enter "08080" (valid postal code) and select 10 miles
        - Verify that table appears
    - Click Reports -> Navigate to generate_reports.php

### Manufacturer/Model Search
From Generate Hemkraft Reports Page
- Click Manufacturer/Model Search Report button -> manufacturer_model_search.php
    - Verify that the Manufacturer/Model Search search bar appears
    - Enter whitespace (enter nothing or only spaces)
        - Verify that error appears
    - Enter "Adwerax" (valid text)
        - Verify that manufacturer list appears and cells with matching text are highlighted
    - Enter "ar" (valid text)
        - Verify that manufacturer list appears and cells with matching text are highlighted
    - Click Reports -> Navigate to generate_reports.php

### Extra Fridge/Freezer Report
From Generate Hemkraft Reports Page
- Click Extra Frige/Freezer Report -> Navigate to extra_fridge_freezer_report.php
    - Click Reports -> Navigate to generate_reports.php

### Bathroom Statistics Report
From Generate Hemkraft Reports Page
- Click Extra Fridge/Freezer Report -> Navigate to extra_fridge_freezer_report.php
    - Click Reports -> Navigate to generate_reports.php

## Enter Household
From Generate Hemkraft Reports Page
- Click Return to Main Menu -> Navigate to MainMenu.php
    - Click "Add in new household" -> Navigate to enter_email_address.php

### Enter Email Address

- Enter "" (Blank) 
    - Verify _Blank email_ error is displayed
- Enter "jtagala@rantouch.com" (existing email)
    - Verify _Existing email_ error is displayed
- Enter "PBurdell@gatech.edu" -> Navigate to enter_postal_code.php

### Enter Postal Code

- Enter "" (Blank)
    - Verify _Blank postal code_ error is displayed
- Enter "98765" -> Error: postal code does not exist
    - Verify _Invalid postal code_ error is diplayed
- Enter "55302"
    - Verify alert showing Annandale, MN is displayed
    - Click no to return to postal code input back to Enter postal code
- Enter "30334"
    - Verify alert showing Atlanta, Georgia is displayed
    - Click yes -> navigate to enter_phone_number_form

### Enter Phone Number

- Click No 
    - Verify form is disabled or disabled/hidden
    - Mention the user is allowed to proceed with no phone number
- Click Yes 
    - Verify form is enabled or unhidden
    - Enter Area Code: "" (Blank), Number: "" (Blank), Phone Type: "mobile"
        - Verify _Blank Phone number_ error is displayed
    - Enter Area Code: "010" , Number: "7767361" , Phone Type: "mobile"
        - Verify _Need dash in number_ error is displayed
    - Enter Area Code: "010" , Number: "776-7361" , Phone Type: "mobile"
        - Verify _Phone number already exists_ error is displayed
    - Enter Area Code: "555" , Number: "012-3456" , Phone Type: "mobile" -> Navigate to enter_houseinfo.php

### Enter Household Form

- Enter Home Type: "house", Square Footage: "" (Blank), Occupants: "" (Blank), Bedrooms: "" (Blank)
    - Verify input error is shown
- Enter Home Type: "house", Square Footage: "string", Occupants: "1", Bedrooms: "1"
    - Verify input error is shown
- Enter Home Type: "house", Square Footage: "0", Occupants: "1" , Bedrooms: "1"
    - Verify input error is shown
- Enter Home Type: "house", Square Footage: "2000", Occupants: "3", Bedrooms: "4" -> navigate to enter_bathroom.php

### Enter Bathroom

- Click "Fullbath" -> Navigate to enter_fullbathinfo.php
    - Enter Primary: Checked, Sinks: 0, Commodes: 0, Bidets: 0, Bathtubs: 0, Showers: 0, Tub/Showers: 0
        - Verify _Min. requirement_ error is displayed
    - Enter Primary: Checked, Sinks: 1, Commodes: 1, Bidets: 0, Bathtubs: 1, Showers: 0, Tub/Showers: 0 -> Navigate to view_bathinfo.php
- Click Add another bathroom -> nav to enter_bathroom.php
- Click Fullbath -> Navigate to enter_fullbathinfo.php
    - Mention primary grayed out (and unchecked)
    - Enter Primary: Unchecked, Sinks: 1, Commodes: 1, Bidets: 1, Bathtubs: 0, Showers: 0, Tub/Showers: 1 -> Navigate to view_bathinfo.php
- Click Add another bathroom -> Navigate to to enter_bathroom.php
- Click Enter Half bath -> Navigate to enter_halfbathinfo.php
    - Enter Sinks: 0, Commodes: 0, Bidets: 0, Optional Name: "" (Blank)
        - Verify _Min. requirement_ error is displayed
    - Enter Sinks: 0, Commodes: 0, Bidets: 0, Optional Name: "Guest Bathroom" -> Navigate to view_bathinfo.php
- Click Go to Appliance -> Navigate to enter_appliance.php

### Enter Appliance

- Click Refrigerator/freezer -> Navigate to enter_Refrigerator.php
    - Enter Refrigerator type: "Bottom freezer", Manufacturer: "Bareredgantor Holdings Group", Model Name: "Pat" -> Navigate to view_applianceinfo.php
    - Click add another appliance -> Navigate to enter_appliance.php
- Click cooker -> Navigate to enter_Cooker.php
    - Click "Both Oven and Cooktop" -> Navigate to enter_Cooker_both.php
    - Enter Manufacturer: "Bareredgantor Holdings Group", Model Name: "Peter", Oven Heat Source: "microwave", Cooktop Heat Source: "induction" -> view_applianceinfo.php
    - Click add another appliance -> Navigate enter_appliance.php
- Click add Washer -> Navigate to enter_Washer.php
    - Enter Washer Loading Type: "front load", manufacturer: "Bareredgantor Holdings Group", model name: "" (Blank) -> view_applianceinfo.php
    - Click add another appliance -> Navigate enter_appliance.php
- Click Dryer -> Navigate to enter_Dryer.php
    - Enter Heat source: "electric", Manufacturer: "Bareredgantor Holdings Group", Model Name: "Pooja"
    - Click next -> view_applianceinfo.php
    - Click add another appliance -> Navigate enter_appliance.php
- Click Tv -> Navigate to enter_TV.php
    - Enter  Max Resolution: "480i", Display size: "55.15", manufacturer: "Adbanonover", Model Name: "" (Blank)
        - Verify _only numbers accepted_ error is displayed
    - Enter  Max Resolution: "480i", Display size: "55.15", manufacturer: "Bareredgantor Holdings Group", Model Name: "Leo Mark" -> view_applianceinfo.php
    - Click Finish adding and Submit -> Navigate wrap_up.php
- Click Return to Main Menu -> MainMenu.php

## Proof of insert

### Top 25 Manufacturers Report
From Generate Hemkraft Reports Page    
- Click Top 25 Manufacturer Report -> Navigate to top_manufacturers.php
    - Click "Bareredgantor Holdings Group" -> Navigate to manufacturer_drilldown_report.php?manufacturer=Bareredgantor+Holdings+Group
        - Click return to manufacturer report -> Navigate vack to top_manufacturers.php
    - Click Reports -> Navigate to generate_reports.php

### Manufacturer/Model Search
From Generate Hemkraft Reports Page
- Click Manufacturer/Model Search Report button -> manufacturer_model_search.php
    - Enter "alex" (valid text)
        - Verify that manufacturer list appears and cells with matching text are highlighted
    - Click Reports -> Navigate to generate_reports.php
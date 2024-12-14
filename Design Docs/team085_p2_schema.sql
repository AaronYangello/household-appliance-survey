CREATE TABLE Region (
  PostalCode VARCHAR(5) NOT NULL,
  City VARCHAR(250) NOT NULL,
  State VARCHAR(250) NOT NULL,
  Latitude FLOAT,
  Longitude FLOAT,
  Primary Key(PostalCode)
);

CREATE TABLE Household (
	EmailAddress VARCHAR(250) NOT NULL,
	SquareFootage INT NOT NULL DEFAULT 0,
	Occupants INT(20) NOT NULL DEFAULT 0,
    Bedrooms INT(30) NOT NULL DEFAULT 0,
    HomeType ENUM('house', 'apartment', 'townhome', 'condominium', 'mobile home') NOT NULL,
    PostalCode VARCHAR(10) NOT NULL,
    PRIMARY KEY(EmailAddress),
    FOREIGN KEY(PostalCode) REFERENCES Region(PostalCode)
);

CREATE TABLE PhoneNumber (
	AreaCode VARCHAR(3)  NOT NULL,
	Number VARCHAR(7) NOT NULL,
    PhoneType ENUM('home', 'mobile', 'work', 'other') NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	PRIMARY KEY(AreaCode, Number),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress)
);

CREATE TABLE HalfBath (
  BathroomNumber INT(30) unsigned  NOT NULL,
  Sinks INT(30) NOT NULL,
  Bidets INT(30) NOT NULL,
  Commodes INT(30) NOT NULL,
  Name VARCHAR(250) NULL,
  EmailAddress VARCHAR(250) NOT NULL,
  PRIMARY KEY(BathroomNumber, EmailAddress),
  FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress)
 );

 CREATE TABLE FullBath (
  BathroomNumber INT(30) unsigned NOT NULL,
  Sinks INT(30) NOT NULL,
  Bidets INT(30) NOT NULL,
  Commodes INT(30) NOT NULL,
  IsPrimary BOOLEAN NULL,
  TubShowerCount INT(30) NOT NULL,
  ShowerCount INT(30) NOT NULL,
  BathtubCount INT(30) NOT NULL,
  EmailAddress VARCHAR(250) NOT NULL,
  PRIMARY KEY(BathroomNumber, EmailAddress),
  FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress)
 );

CREATE TABLE Manufacturer (
	ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY (ManufacturerName)
);

CREATE TABLE Refrigerator (
	ApplianceNumber INT(30) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	ModelName VARCHAR(250) NULL,
	RefrigeratorType ENUM('bottom freezer','french door','side-by-side','top freezer','chest freezer','upright freezer'),
    ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ManufacturerName) REFERENCES Manufacturer(ManufacturerName)
);

CREATE TABLE Washer (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	ModelName VARCHAR(50) NULL,
	LoadingType ENUM('top', 'front') NOT NULL,
    ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ManufacturerName) REFERENCES Manufacturer(ManufacturerName)
);

CREATE TABLE Dryer (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	ModelName VARCHAR(50) NULL,
	HeatSource ENUM('gas', 'electric', 'none') NOT NULL,
    ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ManufacturerName) REFERENCES Manufacturer(ManufacturerName)
);

CREATE TABLE Tv (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	ModelName VARCHAR(50) NULL,
	DisplayType ENUM('tube','DLP','plasma','LCD','LED') NOT NULL,
	DisplaySize double NOT NULL,
	MaximumResolution ENUM('480i','576i','720p','1080i','1080p','1440p','2160p (4K)','4320p (8K)') NOT NULL,
    ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ManufacturerName) REFERENCES Manufacturer(ManufacturerName)
);

CREATE TABLE Cooker (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	ModelName VARCHAR(50) NULL,
    ManufacturerName VARCHAR(250) NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ManufacturerName) REFERENCES Manufacturer(ManufacturerName)
);

CREATE TABLE Cooktop (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	HeatSource ENUM('gas','electric','radiant electric','induction') NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ApplianceNumber) REFERENCES Cooker(ApplianceNumber)
);

CREATE TABLE Oven (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	OvenType ENUM('convection','conventional') NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ApplianceNumber) REFERENCES Cooker(ApplianceNumber)
);

CREATE TABLE OvenHeatSource (
	ApplianceNumber INT(16) unsigned NOT NULL,
	EmailAddress VARCHAR(250) NOT NULL,
	HeatSource ENUM('gas','electric','microwave') NOT NULL,
	PRIMARY KEY(ApplianceNumber, EmailAddress, HeatSource),
	FOREIGN KEY(EmailAddress) REFERENCES Household(EmailAddress),
	FOREIGN KEY(ApplianceNumber) REFERENCES Oven(ApplianceNumber)
);
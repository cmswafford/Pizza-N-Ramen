CREATE TABLE Users( UserID INT UNSIGNED AUTO_INCREMENT
                   ,Username VARCHAR(32) DEFAULT NULL
                   ,Email VARCHAR(64) DEFAULT NULL
                   ,Password VARCHAR(64) DEFAULT NULL /* Use sha256 hashes */
                   ,Status TINYINT(1) DEFAULT 1 /* User group */
                   ,PRIMARY KEY (UserID)
                   ,UNIQUE (Name)
                  ) ENGINE=InnoDB;

CREATE TABLE Recipes( RecipeID INT UNSIGNED AUTO_INCREMENT 
                     ,RecipeTitle VARCHAR(64) DEFAULT NULl
                     ,UserID INT UNSIGNED DEFAULT NULL
                     ,SkillLevel SMALLINT DEFAULT NULL
                     ,PRIMARY KEY (RecipeID)
                     ,FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
                    ) ENGINE=InnoDB;

CREATE TABLE Ingredients( IngredientID INT UNSIGNED AUTO_INCREMENT
                         ,IngredientName VARCHAR(64) DEFAULT NULL
                         ,PRIMARY KEY (IngredientID)
                        ) ENGINE=InnoDB;

CREATE TABLE RecipeIngredients( RecipeID INT UNSIGNED
                               ,IngredientID INT UNSIGNED
                               ,ServingSize VARCHAR(128) DEFAULT NULL
                               ,PRIMARY KEY (RecipeID,IngredientID)
                               ,FOREIGN KEY (RecipeID) REFERENCES Recipes(RecipeID) ON DELETE CASCADE
                              ) ENGINE=InnoDB;

CREATE TABLE RecipeVotes( RecipeID INT UNSIGNED
                         ,UserID INT UNSIGNED
                         ,Vote SMALLINT(1) SIGNED DEFAULT 0
                         ,PRIMARY KEY (UserID,RecipeID)
                         ,FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
                         ,FOREIGN KEY (RecipeID) REFERENCES Recipes(RecipeID) ON DELETE CASCADE
                        ) ENGINE=InnoDB;

CREATE TABLE RecipeComments( CommentID INT UNSIGNED AUTO_INCREMENT
                            ,RecipeID INT UNSIGNED DEFAULT NULL
                            ,Comment TEXT DEFAULT NULL
                            ,PRIMARY KEY (CommentID)
                            ,FOREIGN KEY (RecipeID) REFERENCES Recipes(RecipeID) ON DELETE CASCADE
                           ) ENGINE=InnoDB;

CREATE TABLE Tags( TagID INT UNSIGNED AUTO_INCREMENT
                  ,TagName VARCHAR(32) DEFAULT NULL
                  ,PRIMARY KEY (IngredientID)
                  ,INDEX(TagName)
                 ) ENGINE=InnoDB;

CREATE TABLE RecipeTagged( TagID INT UNSIGNED
                          ,RecipeID INT UNSIGNED
                          ,PRIMARY KEY (TagID,RecipeID)
                         ) ENGINE=InnoDB;

/*CREATE TABLE Instructions( InstructionID INT UNSIGNED AUTO_INCREMENT 
                          ,RecipeID INT UNSIGNED DEFAULT NULL
                          ,Number SMALLINT UNSIGNED DEFAULT NULL
                          ,Instruction TEXT DEFAULT NULL
                          ,PRIMARY_KEY (InstructionID)
                         ) ENGINE=InnoDB;
*/

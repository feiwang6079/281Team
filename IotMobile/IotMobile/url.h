//
//  url.h
//  IotMobile
//
//  Created by fei wang on 2018/12/4.
//  Copyright © 2018 fei wang. All rights reserved.
//

#ifndef url_h
#define url_h

//#define LOGIN_URL @"http://localhost/New_281_Team/API/RestController.php?view=login"
//#define BUILDING_URL @"http://localhost/New_281_Team/API/RestController.php?view=buildinglist"
//#define FLOOR_URL @"http://localhost/New_281_Team/API/RestController.php?view=floorlist"
//#define NODE_URL @"http://localhost/New_281_Team/API/RestController.php?view=nodelist"
//#define SENSOR_URL @"http://localhost/New_281_Team/API/RestController.php?view=sensorlist"

#define LOGIN_URL @"http://iot.feiwang.tech/API/RestController.php?view=login"
#define BUILDING_URL @"http://iot.feiwang.tech/API/RestController.php?view=buildinglist"
#define FLOOR_URL @"http://iot.feiwang.tech/API/RestController.php?view=floorlist"
#define NODE_URL @"http://iot.feiwang.tech/API/RestController.php?view=nodelist"
#define SENSOR_URL @"http://iot.feiwang.tech/API/RestController.php?view=sensorlist"

// 2.获得RGB颜色
#define RGBA(r, g, b, a)                    [UIColor colorWithRed:r/255.0f green:g/255.0f blue:b/255.0f alpha:a]
#define RGB(r, g, b)                        RGBA(r, g, b, 1.0f)

#define navigationBarColor RGB(33, 192, 174)

#endif /* url_h */

//
//  SensorListViewController.m
//  IotMobile
//
//  Created by fei wang on 2018/12/3.
//  Copyright © 2018 fei wang. All rights reserved.
//

#import "SensorListViewController.h"
#import "AFNetworking/AFNetworking.h"
#import "SVProgressHUD/SVProgressHUD.h"
#import "BuildingCell.h"
#import "SensorCell.h"

@interface SensorListViewController ()

@property(strong, nonatomic)NSArray *buildingArray;
@property (weak, nonatomic) IBOutlet UITableView *listTableView;

@end

@implementation SensorListViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.navigationController.navigationBar.hidden = NO;
    self.navigationItem.title = @"Sensor List";
    _buildingArray = [NSArray array];
    
    NSString *requestUrl = @"http://localhost/New_281_Team/API/RestController.php?view=sensorlist";
    NSDictionary *dic = [NSDictionary dictionaryWithObjectsAndKeys:self.nodeId, @"node", nil];
    
    AFHTTPSessionManager *manager = [AFHTTPSessionManager manager];
    manager.responseSerializer.acceptableContentTypes = [[NSSet alloc] initWithObjects: @"application/json",nil];
    [manager.requestSerializer setValue:@"application/json" forHTTPHeaderField:@"Accept"];
    
    [manager GET:requestUrl parameters:dic success:^(NSURLSessionTask *task, id responseObject) {
        if([responseObject isKindOfClass:[NSArray class]])
        {
            self.buildingArray = (NSArray *)responseObject;
            [self.listTableView reloadData];
        }
        else
        {
            [SVProgressHUD showErrorWithStatus:@"Get Data Failed"];
        }
        
    } failure:^(NSURLSessionTask *operation, NSError *error) {
        NSLog(@"Error: %@", error);
        [SVProgressHUD showErrorWithStatus:@"Get Data Failed"];
    }];
    
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return [_buildingArray count];
}


- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    SensorCell *cell = [tableView dequeueReusableCellWithIdentifier:@"sensor"];
    if(cell == nil)
    {
        cell = [[[NSBundle mainBundle] loadNibNamed:@"SensorCell" owner:self options:nil] firstObject];
    }
    
    NSDictionary *dic = [self.buildingArray objectAtIndex:indexPath.row];
    cell.idLabel.text = [dic objectForKey:@"sensor_id"];
    cell.typeLabel.text = [dic objectForKey:@"sensor_type"];
    cell.statusLabel.text = [dic objectForKey:@"sensor_status"];
    cell.timeLabel.text = [dic objectForKey:@"time"];
    
    return cell;
}


@end

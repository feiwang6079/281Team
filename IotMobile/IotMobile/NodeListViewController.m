//
//  NodeListViewController.m
//  IotMobile
//
//  Created by fei wang on 2018/12/3.
//  Copyright © 2018 fei wang. All rights reserved.
//

#import "NodeListViewController.h"
#import "FloorCell.h"
#import "AFNetworking/AFNetworking.h"
#import "SVProgressHUD/SVProgressHUD.h"
#import "BuildingCell.h"

@interface NodeListViewController ()

@property(strong, nonatomic)NSArray *buildingArray;
@property (weak, nonatomic) IBOutlet UITableView *listTableView;

@end

@implementation NodeListViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.navigationController.navigationBar.hidden = NO;
    self.navigationItem.title = @"Room Node List";
    _buildingArray = [NSArray array];
    
    NSString *requestUrl = @"http://localhost/New_281_Team/API/RestController.php?view=nodelist";
    NSDictionary *dic = [NSDictionary dictionaryWithObjectsAndKeys:self.floorId, @"floor", nil];
    
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
    FloorCell *cell = [tableView dequeueReusableCellWithIdentifier:@"floor"];
    if(cell == nil)
    {
        cell = [[[NSBundle mainBundle] loadNibNamed:@"FloorCell" owner:self options:nil] firstObject];
    }
    
    NSDictionary *dic = [self.buildingArray objectAtIndex:indexPath.row];
    cell.idLabel.text = [dic objectForKey:@"node_id"];
    cell.locationLabel.text = [dic objectForKey:@"location"];
    cell.statusLabel.text = [dic objectForKey:@"status"];
    cell.timeLabel.text = [dic objectForKey:@"time"];
    
    return cell;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    
}

@end

//
//  FloorListViewController.m
//  IotMobile
//
//  Created by fei wang on 2018/12/3.
//  Copyright © 2018 fei wang. All rights reserved.
//

#import "FloorListViewController.h"
#import "AFNetworking/AFNetworking.h"
#import "SVProgressHUD/SVProgressHUD.h"
#import "BuildingCell.h"
#import "FloorCell.h"
#import "NodeListViewController.h"
#import "url.h"

@interface FloorListViewController ()<UITableViewDataSource, UITableViewDelegate>

@property(strong, nonatomic)NSArray *buildingArray;
@property (weak, nonatomic) IBOutlet UITableView *listTableView;


@end

@implementation FloorListViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.navigationController.navigationBar.hidden = NO;
    self.navigationController.navigationBar.backgroundColor = navigationBarColor;

    self.navigationItem.title = @"Floor Cluster List";
    _buildingArray = [NSArray array];
    

    NSDictionary *dic = [NSDictionary dictionaryWithObjectsAndKeys:self.buildingId, @"building", nil];
    
    AFHTTPSessionManager *manager = [AFHTTPSessionManager manager];
    manager.responseSerializer.acceptableContentTypes = [[NSSet alloc] initWithObjects: @"application/json",nil];
    [manager.requestSerializer setValue:@"application/json" forHTTPHeaderField:@"Accept"];
    
    [manager GET:FLOOR_URL parameters:dic success:^(NSURLSessionTask *task, id responseObject) {
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
    cell.idLabel.text = [dic objectForKey:@"floor_cluster_id"];
    cell.locationLabel.text = [dic objectForKey:@"location"];
    cell.statusLabel.text = [dic objectForKey:@"status"];
    cell.timeLabel.text = [dic objectForKey:@"time"];
    
    return cell;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    NodeListViewController *flvc = [[NodeListViewController alloc] init];
    NSDictionary *dic = [self.buildingArray objectAtIndex:indexPath.row];
    flvc.floorId = [dic objectForKey:@"floor_cluster_id"];
    [self.navigationController pushViewController:flvc animated:YES];
}
@end

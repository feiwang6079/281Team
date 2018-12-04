//
//  BuildingListViewController.m
//  IotMobile
//
//  Created by fei wang on 2018/12/3.
//  Copyright © 2018 fei wang. All rights reserved.
//

#import "BuildingListViewController.h"
#import "AFNetworking/AFNetworking.h"
#import "SVProgressHUD/SVProgressHUD.h"
#import "BuildingCell.h"
#import "FloorListViewController.h"
#import "url.h"

@interface BuildingListViewController ()<UITableViewDelegate, UITableViewDataSource>

@property(strong, nonatomic)NSArray *buildingArray;
@property (weak, nonatomic) IBOutlet UITableView *listTableView;


@end

@implementation BuildingListViewController

-(void)viewWillAppear:(BOOL)animated
{
    self.navigationController.navigationBar.hidden = YES;

}

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.navigationController.navigationBar.hidden = YES;
    _buildingArray = [NSArray array];
    

    NSDictionary *dic = [NSDictionary dictionaryWithObjectsAndKeys:@"1", @"building", nil];

    AFHTTPSessionManager *manager = [AFHTTPSessionManager manager];
    manager.responseSerializer.acceptableContentTypes = [[NSSet alloc] initWithObjects: @"application/json",nil];
    [manager.requestSerializer setValue:@"application/json" forHTTPHeaderField:@"Accept"];
    
    [manager GET:BUILDING_URL parameters:dic success:^(NSURLSessionTask *task, id responseObject) {
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
    BuildingCell *cell = [tableView dequeueReusableCellWithIdentifier:@"building"];
    if(cell == nil)
    {
        cell = [[[NSBundle mainBundle] loadNibNamed:@"BuildingCell" owner:self options:nil] firstObject];
    }
    
    NSDictionary *dic = [self.buildingArray objectAtIndex:indexPath.row];
    cell.nameLabel.text = [dic objectForKey:@"building_name"];
    cell.addressLabel.text = [dic objectForKey:@"building_address"];
    
    return cell;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    FloorListViewController *flvc = [[FloorListViewController alloc] init];
    NSDictionary *dic = [self.buildingArray objectAtIndex:indexPath.row];
    flvc.buildingId = [dic objectForKey:@"building_id"];
    [self.navigationController pushViewController:flvc animated:YES];
}


/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end

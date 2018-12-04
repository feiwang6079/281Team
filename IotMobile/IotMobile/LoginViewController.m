//
//  LoginViewController.m
//  IotMobile
//
//  Created by fei wang on 2018/12/3.
//  Copyright © 2018 fei wang. All rights reserved.
//

#import "LoginViewController.h"
#import "AFNetworking/AFNetworking.h"
#import "SVProgressHUD/SVProgressHUD.h"
#import "BuildingListViewController.h"
#import "url.h"

@interface LoginViewController ()<UITextFieldDelegate>

@property (weak, nonatomic) IBOutlet UITextField *userTextField;

@property (weak, nonatomic) IBOutlet UITextField *passwordTextField;

@end

@implementation LoginViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
}


- (IBAction)buttonClick:(id)sender {
    
    
    if([self.userTextField.text isEqualToString:@""] || [self.passwordTextField.text isEqualToString:@""])
    {
    }
    else
    {
        [SVProgressHUD setDefaultStyle:SVProgressHUDStyleDark];
        [SVProgressHUD setMinimumDismissTimeInterval:0.5];
        
        
        AFHTTPSessionManager *manager = [AFHTTPSessionManager manager];
        manager.responseSerializer.acceptableContentTypes = [[NSSet alloc] initWithObjects: @"application/json",nil];
        [manager.requestSerializer setValue:@"application/json" forHTTPHeaderField:@"Accept"];
        
        NSDictionary *dic = [NSDictionary dictionaryWithObjectsAndKeys:self.userTextField.text, @"user", self.passwordTextField.text, @"password", nil];
        [manager GET:LOGIN_URL parameters:dic success:^(NSURLSessionTask *task, id responseObject) {
            NSDictionary *dic = (NSDictionary *)responseObject;
            if([dic objectForKey:@"error"] != nil)
            {
                [SVProgressHUD showErrorWithStatus:@"Login Failed"];

            }
            else
            {
                BuildingListViewController *bvc = [[BuildingListViewController alloc] init];
                [self.navigationController pushViewController:bvc animated:YES];
            }

        } failure:^(NSURLSessionTask *operation, NSError *error) {
            NSLog(@"Error: %@", error);
        }];
        
    }

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
